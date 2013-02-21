function Admin_JsWebFormsLogicRuleCheck(logic, prefix) {
    var flag = false;
    var field = $$('[name="'+prefix+'[field][' + logic['field_id'] + ']"]');
    var field_type = 'select';
    var selected = 'selected';
    if (typeof(field[0]) != 'object') {
        input = $$('[name="'+prefix+'[field][' + logic['field_id'] + '][]"]');
        field_type = 'radio';
        selected = 'checked';
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

function Admin_JsWebFormsLogicTargetCheck(target, logicRules, prefix) {
    if(typeof(target["id"]) == 'undefined') return false;
    var flag = false;
    for (var i in logicRules) {
        for (var j in logicRules[i]['target']) {
            if (target["id"] == logicRules[i]['target'][j]) {
                if (Admin_JsWebFormsLogicRuleCheck(logicRules[i], prefix)) {
                    flag = true;
                    var config = logicRules[i];
                    break;
                }
            }
        }
    }
    var initState = "none";
    var styleDisplay = "block";
    if (target["id"].match('field_')){
        styleDisplay = "table-row";
    }
    if (target["logic_visibility"] == 'visible')
        initState = styleDisplay;
    var changeState = styleDisplay;
    var display = initState;
    if (flag) {
        if (config['action'] == "hide") {
            changeState = "none";
        }
        display = changeState;
    }
    if (typeof($(target["id"] + '_container')) == 'object' && $(target["id"] + '_container').style) {
        $(target["id"] + '_container').style.display = display;
    }
    return flag;
}

function Admin_JSWebFormsLogic(targets, logicRules, prefix) {
    for (var n in logicRules) {
        var config = logicRules[n];
        if (typeof(config) == 'object') {
            var input = $$('[name="'+prefix+'[field][' + config['field_id'] + ']"]');
            var trigger_function = 'onchange';
            if (typeof(input[0]) != 'object') {
                input = $$('[name="'+prefix+'[field][' + config['field_id'] + '][]"]');
                trigger_function = 'onclick';
            }
            for (var i in input) {
                if (trigger_function == 'onchange')
                    input[i].onchange = function () {
                        for (var k in targets)
                            Admin_JsWebFormsLogicTargetCheck(targets[k], logicRules, prefix);
                    }
                else
                    input[i].onclick = function () {
                        for (var k in targets)
                            Admin_JsWebFormsLogicTargetCheck(targets[k], logicRules, prefix);
                    }
            }
        }
    }
}