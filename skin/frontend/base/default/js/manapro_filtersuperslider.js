/**
 * @category    Mana
 * @package     ManaPro_FilterSuperSlider
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */
var ManaPro = ManaPro || {};
ManaPro.filterSuperSlider = function(id, o) {
    function _round(value) {
        if (o.existingValues.length) {
            var distance = 0;
            var found = -1;
            o.existingValues.each(function (item, index) {
                if (found == -1 || distance >= Math.abs(item - value)) {
                    found = index;
                    distance = Math.abs(item - value);
                }
            });
            //console.log(value + ' => ' + o.existingValues[found]);
            value = parseFloat(o.existingValues[found]);
        }
        if (o.formatThreshold && value >= o.formatThreshold) {
            return o.decimalDigits2 ? value.toFixed(o.decimalDigits2) : value.round();
        }
        else {
            return o.decimalDigits ? value.toFixed(o.decimalDigits) : value.round();
        }
    }
    function _format(value) {
        if (o.formatThreshold && value >= o.formatThreshold) {
            value = _round(value) / o.formatThreshold;
            value = o.decimalDigits2 ? value.toFixed(o.decimalDigits2) : value.round();
            return o.numberFormat2.replace('0', value + '');
        }
        else {
            return o.numberFormat.replace('0', _round(value) + '');
        }

    }
    function _change(value, undefined) {
        if (value === undefined) {
            value = [
                parseFloat(jQuery('#'+id+'-applied input.m-slider.m-from').val()),
                parseFloat(jQuery('#'+id+'-applied input.m-slider.m-to').val())
            ];
            if (value[0] == NaN || value[1] == NaN) {
                return;
            }
            else if (value[0] > value[1]) {
                var t = value[0];
                value[0] = value[1];
                value[1] = t;
            }
        }
        if (value[0] <= o.rangeFrom && value[1] >= o.rangeTo) {
            window.setLocation(o.clearUrl);
        }
        else {
            var formattedValue = [_round(value[0]), _round(value[1])];
            window.setLocation(o.url.replace("__0__", formattedValue[0]).replace("__1__", formattedValue[1]));
        }
    }
	var s = new Control.PriceSlider([id + '-from', id + '-to'], id + '-track', {
		spans: [id + '-span'], 
		restricted: true,
		range: $R(o.rangeFrom, o.rangeTo),
		sliderValue: [o.appliedFrom, o.appliedTo]
	});
	
	s.options.onSlide = function(value) {
	    if (o.manualEntry) {
	        jQuery('#'+id+'-applied input.m-slider.m-from').val(_round(value[0]));
            jQuery('#'+id+'-applied input.m-slider.m-to').val(_round(value[1]));
	    }
	    else {
            var formattedValue = [ _format(value[0]), _format(value[1])];
            $(id + '-applied').update(o.appliedFormat.replace("__0__", formattedValue[0]).replace("__1__", formattedValue[1]));
        }
	};
	s.options.onChange = _change;
	var _timer = null;
    jQuery('#'+id+'-applied input.m-slider.m-from').change(function(event) {
        _timer = setTimeout(function() {
            clearTimeout(_timer);
            _timer = null;
            _change();
        }, 100);
    });
    jQuery('#'+id+'-applied input.m-slider.m-to').change(function() {
        _timer = null;
        _change();
    })
    .focus(function() {
        clearTimeout(_timer);
    })
    .blur(function() {
        if (_timer) {
            _timer = null;
            _change();
        }
    });

};