<?php
class VladimirPopov_WebForms_Model_Logic
    extends VladimirPopov_WebForms_Model_Abstract
{
    const VISIBILITY_HIDDEN = 'hidden';
    const VISIBILITY_VISIBLE = 'visible';

    public function _construct()
    {
        parent::_construct();
        $this->_init('webforms/logic');
    }

    public function ruleCheck($data)
    {
        $flag = false;
        $input = $data[$this->getFieldId()];
        if(!is_array($input)) $input = array($input);
        if (
            $this->getAggregation() == VladimirPopov_WebForms_Model_Logic_Aggregation::AGGREGATION_ANY ||
            (
                $this->getAggregation() == VladimirPopov_WebForms_Model_Logic_Aggregation::AGGREGATION_ALL &&
                $this->getLogicCondition() == VladimirPopov_WebForms_Model_Logic_Condition::CONDITION_NOTEQUAL
            )
        ) {
            if ($this->getLogicCondition() == VladimirPopov_WebForms_Model_Logic_Condition::CONDITION_EQUAL) {
                foreach ($input as $input_value) {
                    if (in_array($input_value, $this->getValue()))
                        $flag = true;
                }
            } else {
                $flag = true;
                foreach ($input as $input_value) {
                    if (in_array($input_value, $this->getValue())) $flag = false;
                }
                if (!count($input)) $flag = false;
            }
        } else {
            $flag = true;
            foreach ($this->getValue() as $trigger_value) {
                if (!in_array($trigger_value, $this->getValue())) {
                    $flag = false;
                }
            }
        }

        return $flag;
    }

    public function getTargetVisibility($target, $logic_rules, $data)
    {
        $flag = false;
        foreach ($logic_rules as $logic) {
            foreach ($logic->getTarget() as $t) {
                if ($target["id"] == $t) {
                    if ($logic->ruleCheck($data)) {
                        $flag = true;
                        break;
                    }
                }
            }
        }
        $visibility = false;
        if ($target["logic_visibility"] == self::VISIBILITY_VISIBLE)
            $visibility = true;
        if ($flag) {
            $visibility = true;
            if ($logic->getAction() == VladimirPopov_WebForms_Model_Logic_Action::ACTION_HIDE) {
                $visibility = false;
            }
        }

        return $visibility;
    }
}