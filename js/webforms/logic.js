function JsWebFormsLogicRuleCheck(logic) {
    var flag = false;
    var field = $$('[name="field[' + logic["field_id"] + ']"]');
    var field_type = 'select';
    var selected = 'selected';
    if (typeof(field[0]) != 'object') {
        input = $$('[name="field[' + logic['field_id'] + '][]"]');
        field_type = 'checkbox';
        selected = 'checked';
    } else {
        if (field[0].type == 'radio') {
            field_type = 'radio';
            input = field;
            selected = 'checked';
        }
    }
    if (field_type == 'select')
        var input = field[0].options;
    if (logic['aggregation'] == 'any' || (logic['aggregation'] == 'all' && logic['logic_condition'] == 'notequal')) {
        if (logic['logic_condition'] == 'equal') {
            for (var k in input) {
                if (input[k][selected]) {
                    for (var j in logic['value']) {
                        if (input[k].value == logic['value'][j]) flag = true;
                    }
                }
            }
        } else {
            flag = true;
            var checked = false;
            for (var k in logic['value']) {
                for (var j in input) {
                    if (input[j][selected]) {
                        checked = true;
                        if (input[j].value == logic['value'][k])
                            flag = false;
                    }
                }
            }
            if (!checked) flag = false;
        }
    } else {
        flag = true;
        for (var k in logic['value']) {
            for (var j in input) {
                if (!input[j][selected] && input[j].value == logic['value'][k])
                    flag = false;
            }
        }
    }
    return flag;
}

function JsWebFormsLogicTargetCheck(target, logicRules) {
    var flag = false;
    for (var i in logicRules) {
        for (var j in logicRules[i]['target']) {
            if (target["id"] == logicRules[i]['target'][j]) {
                if (JsWebFormsLogicRuleCheck(logicRules[i])) {
                    flag = true;
                    var config = logicRules[i];
                    break;
                }
            }
        }
    }
    var initState = "none";
    if (target["logic_visibility"] == 'visible')
        initState = "block";
    var changeState = "block";
    var display = initState;
    if (flag) {
        if (config['action'] == "hide") {
            changeState = "none";
        }
        display = changeState;
    }
    if (typeof($(target["id"])) == 'object' && $(target["id"]).style)
        $(target["id"]).style.display = display;
    return flag;
}

function JSWebFormsLogic(targets, logicRules) {
    for (var n in logicRules) {
        var config = logicRules[n];
        if (typeof(config) == 'object') {
            var input = $$('[name="field[' + config["field_id"] + ']"]');
            var trigger_function = 'onchange';
            if (typeof(input[0]) != 'object') {
                input = $$('[name="field[' + config['field_id'] + '][]"]');
                trigger_function = 'onclick';
            } else {
                if (input[0].type == 'radio') {
                    trigger_function = 'onclick';
                }
            }
            for (var i in input) {
                if (trigger_function == 'onchange')
                    input[i].onchange = function () {
                        for (var k in targets)
                            JsWebFormsLogicTargetCheck(targets[k], logicRules);
                    }
                else
                    input[i].onclick = function () {
                        for (var k in targets)
                            JsWebFormsLogicTargetCheck(targets[k], logicRules);
                    }
            }
        }
    }
}