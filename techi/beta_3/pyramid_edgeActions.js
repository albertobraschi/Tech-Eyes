
(function($,Edge,compId){var Composition=Edge.Composition,Symbol=Edge.Symbol;
//Edge symbol: 'stage'
(function(symbolName){Symbol.bindElementAction(compId,symbolName,"document","compositionReady",function(sym,e){sym.setVariable("current","");});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_thermal_go}","click",function(sym,e){});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",750,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",33,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_Thermal_open}","click",function(sym,e){sym.getSymbol("thermal_go").play("in");sym.play("thermal_close");});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_thermal_close}","click",function(sym,e){sym.getSymbol("thermal_go").play("out");sym.play("main");});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_auto-gated-nv_open}","click",function(sym,e){sym.getSymbol("auto-gated-nv_go").play("in");sym.play("auto-gated-nv_close");});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",1250,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"${_auto-gated-nv_close}","click",function(sym,e){sym.getSymbol("auto-gated-nv_go").play("out");sym.play("main");});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",178,function(sym,e){sym.stop();});
//Edge binding end
})("stage");
//Edge symbol end:'stage'

//=========================================================

//Edge symbol: 'thermal_hover'
(function(symbolName){Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",2250,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",5036,function(sym,e){sym.stop();});
//Edge binding end
})("thermal_hover");
//Edge symbol end:'thermal_hover'

//=========================================================

//Edge symbol: 'thermal_close'
(function(symbolName){})("thermal_close");
//Edge symbol end:'thermal_close'

//=========================================================

//Edge symbol: 'auto-gated-nv_go'
(function(symbolName){Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",1500,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",3293,function(sym,e){sym.stop();});
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",250,function(sym,e){sym.stop();});
//Edge binding end
})("auto-gated-nv_go");
//Edge symbol end:'auto-gated-nv_go'

//=========================================================

//Edge symbol: 'imgplaceholder'
(function(symbolName){})("imgplaceholder");
//Edge symbol end:'imgplaceholder'
})(jQuery,AdobeEdge,"EDGE-10891205");