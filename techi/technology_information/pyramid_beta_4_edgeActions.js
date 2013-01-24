/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 129, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_ThermalBut_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("thermal_in");
         sym.getSymbol("allvideo").play("thermal");
         sym.play("thermal_1");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_ThermalBut_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("thermal_out");
         sym.getSymbol("allvideo").play("thermal_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 375, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_AutogatedNVBut_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("autogatednv_in");
         sym.play("autogatednv_1");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_AutogatedNVBut_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("autogatednv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 677, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 966, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3PinnacleBut_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("g3pinnacle_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3PinnacleBut_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("g3pinnacle_in");
         sym.play("g3pinnacle_1");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1199, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen3But_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen3_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen3But_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen3_in");
         sym.play("gen3_1");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1420, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_BWNVBut_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("bwnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_BWNVBut_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("bwnv_in");
         sym.play("bwnv_1");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1614, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen2But_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen2_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen2But_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen2_in");
         sym.play("gen2_1");
         

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1812, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen1But_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen1_in");
         sym.play("gen1_1");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen1But_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen1_out");
         sym.play("reset");
         

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2225, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DaytimeBut_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("daytime_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DaytimeBut_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("daytime_in");
         sym.play("daytime_1");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DigitaLNV_in}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("digitalnv_in");
         sym.play("digitalnv_1");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DigitaLNV_out}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("digitalnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_ThermalBut_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("thermal_out");
         sym.getSymbol("allvideo").play("thermal_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_ThermalBut_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("thermal_out");
         sym.getSymbol("allvideo").play("thermal_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_AutogatedNVBut_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("autogatednv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_AutogatedNVBut_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("autogatednv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3PinnacleBut_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("g3pinnacle_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3PinnacleBut_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("g3pinnacle_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3But_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen3_out");
         sym.play("reset");

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Generation3But_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen3_out");
         sym.play("reset");

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_BWNVBut_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("bwnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_BWNVBut_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("bwnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen2But_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen2_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen2But_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen2_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DigitalNV_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("digitalnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DigitalNV_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("digitalnv_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen1But_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen1_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Gen1But_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all").play("gen1_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DaytimeBut_out_rightside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("daytime_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_DaytimeBut_out_leftside}", "click", function(sym, e) {
         sym.getSymbol("onclick4all2").play("daytime_out");
         sym.play("reset");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "document", "compositionReady", function(sym, e) {

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'onclick4all'
   (function(symbolName) {   
   
      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1138, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2310, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 126, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 3388, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 4560, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 6934, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 7888, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 8934, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 10261, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 11368, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 12638, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 13810, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      

      

      

      

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 5888, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

   })("onclick4all");
   //Edge symbol end:'onclick4all'

   //=========================================================
   
   //Edge symbol: 'onclick4all2'
   (function(symbolName) {   
   
      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 250, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1888, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 3000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 5500, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 4374, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 6000, function(sym, e) {
         // insert code here
      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 6874, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 8000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindSymbolAction(compId, symbolName, "creationComplete", function(sym, e) {
var youtubevid = $("<iframe/>");
sym.$("vcontainer1").append(youtubevid);

youtubevid.attr('type','text/html');
youtubevid.attr('width','320');
youtubevid.attr('height','180');
youtubevid.attr('src','http://www.youtube.com/embed/624HfkMty_8');  // url/Video_Id
youtubevid.attr('frameborder','0');       // 1 | 0
youtubevid.attr('allowfullscreen','0');   // 1 | 0

      });
      //Edge binding end

   })("onclick4all2");
   //Edge symbol end:'onclick4all2'

   //=========================================================
   
   //Edge symbol: 'allvideo'
   (function(symbolName) {   
   
      Symbol.bindSymbolAction(compId, symbolName, "creationComplete", function(sym, e) {
         var youtubevid = $("<iframe/>");
         sym.$("thermalvideo").append(youtubevid);
         
         youtubevid.attr('type','text/html');
         youtubevid.attr('width','320');
         youtubevid.attr('height','180');
         youtubevid.attr('src','http://www.youtube.com/embed/skU-jBFzXl0');  // url/Video_Id
         youtubevid.attr('frameborder','0');       // 1 | 0
         youtubevid.attr('allowfullscreen','0');   // 1 | 0

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1500, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2250, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

   })("allvideo");
   //Edge symbol end:'allvideo'

})(jQuery, AdobeEdge, "EDGE-741842822");