/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};


var resources = [
];
var symbols = {
"stage": {
   version: "1.0.0",
   minimumCompatibleVersion: "0.1.7",
   build: "1.0.0.185",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
         dom: [
         {
            id:'Beta_Ver',
            type:'text',
            rect:['827px','42px','137px','63px','auto','auto'],
            text:"Beta 4.1<br>12.13.2012",
            align:"right",
            font:['Arial, Helvetica, sans-serif',24,"rgba(0,0,0,1)","normal","none",""]
         },
         {
            id:'Text',
            type:'text',
            rect:['708px','108px','261px','42px','auto','auto'],
            text:"(All Bugs Fixed, Pyramid is now fully functional)",
            align:"left",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,0,0,1)","normal","none","normal"]
         },
         {
            id:'Pyramind_Parts',
            type:'group',
            rect:['9','21','960','987','auto','auto'],
            c:[
            {
               id:'autogatedNV',
               type:'image',
               rect:['343px','141px','276px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"autogatedNV.png",'0px','0px']
            },
            {
               id:'bwNV',
               type:'image',
               rect:['482px','423px','276px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"bwNV.png",'0px','0px']
            },
            {
               id:'daytimeoptics',
               type:'image',
               rect:['0px','846px','960px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"daytimeoptics.png",'0px','0px']
            },
            {
               id:'digitalNV',
               type:'image',
               rect:['482px','564px','347px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"digitalNV.png",'0px','0px']
            },
            {
               id:'generation1',
               type:'image',
               rect:['67px','705px','825px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"generation1.png",'0px','0px']
            },
            {
               id:'generation2',
               type:'image',
               rect:['135px','564px','347px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"generation2.png",'0px','0px']
            },
            {
               id:'generation3',
               type:'image',
               rect:['206px','423px','276px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"generation3.png",'0px','0px']
            },
            {
               id:'generation3_pinnacle',
               type:'image',
               rect:['273px','282px','415px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"generation3_pinnacle.png",'0px','0px']
            },
            {
               id:'thermal',
               type:'image',
               rect:['412px','0px','139px','141px','auto','auto'],
               fill:["rgba(0,0,0,0)",im+"thermal.png",'0px','0px']
            }]
         },
         {
            id:'onclick4all',
            type:'rect',
            rect:['19px','25','auto','auto','auto','auto']
         },
         {
            id:'onclick4all2',
            type:'rect',
            rect:['6','21','auto','auto','auto','auto']
         },
         {
            id:'Group_of_buttons',
            type:'group',
            rect:['215','0','1112','987','auto','auto'],
            c:[
            {
               id:'ThermalBut_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'ThermalBut_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'ThermalBut_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'ThermalBut_in',
               type:'rect',
               rect:['-23px','506px','139px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'AutogatedNVBut_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'AutogatedNVBut_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'AutogatedNVBut_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'AutogatedNVBut_in',
               type:'rect',
               rect:['-23px','506px','276px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3PinnacleBut_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3PinnacleBut_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3PinnacleBut_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3PinnacleBut_in',
               type:'rect',
               rect:['-23px','506px','415px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen3But_out',
               display:'none',
               type:'rect',
               rect:['1px','0px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3But_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Generation3But_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen3But_in',
               type:'rect',
               rect:['-23px','506px','276px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'BWNVBut_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'BWNVBut_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'BWNVBut_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'BWNVBut_in',
               type:'rect',
               rect:['-23px','506px','276px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen2But_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen2But_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen2But_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen2But_in',
               type:'rect',
               rect:['-23px','506px','347px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DigitaLNV_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DigitalNV_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DigitalNV_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DigitaLNV_in',
               type:'rect',
               rect:['275px','585px','344px','141px','auto','auto'],
               opacity:1,
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgb(0, 0, 0)","none"]
            },
            {
               id:'Gen1But_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen1But_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen1But_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'Gen1But_in',
               type:'rect',
               rect:['-23px','506px','823px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DaytimeBut_out',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DaytimeBut_out_rightside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DaytimeBut_out_leftside',
               display:'none',
               type:'rect',
               rect:['360px','-21px','975px','347px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            },
            {
               id:'DaytimeBut_in',
               type:'rect',
               rect:['-23px','506px','958px','141px','auto','auto'],
               fill:["rgba(192,192,192,1)"],
               stroke:[0,"rgba(0,0,0,1)","none"]
            }]
         },
         {
            id:'allvideo',
            type:'rect',
            rect:['132','241','auto','auto','auto','auto']
         }],
         symbolInstances: [
         {
            id:'allvideo',
            symbolName:'allvideo'
         },
         {
            id:'onclick4all',
            symbolName:'onclick4all'
         },
         {
            id:'onclick4all2',
            symbolName:'onclick4all2'
         }
         ]
      },
   states: {
      "Base State": {
         "${_thermal}": [
            ["style", "height", '141px'],
            ["style", "top", '0px'],
            ["style", "left", '412px'],
            ["style", "width", '139px']
         ],
         "${_Gen2But_in}": [
            ["style", "top", '584px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '-71px'],
            ["style", "width", '347px']
         ],
         "${_BWNVBut_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-213px'],
            ["style", "width", '975px']
         ],
         "${_Generation3PinnacleBut_in}": [
            ["style", "top", '303px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '68px'],
            ["style", "width", '415px']
         ],
         "${_DigitalNV_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '546.3px'],
            ["style", "width", '350px']
         ],
         "${_Gen1But_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-349.6px'],
            ["style", "width", '350px']
         ],
         "${_Generation3PinnacleBut_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-213px'],
            ["style", "width", '975px']
         ],
         "${_generation3_pinnacle}": [
            ["style", "left", '273px'],
            ["style", "top", '281.57px']
         ],
         "${_Gen2But_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-215px'],
            ["style", "width", '975px']
         ],
         "${_Generation3But_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '547.77px'],
            ["style", "width", '350px']
         ],
         "${_Gen1But_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '547.63px'],
            ["style", "width", '350px']
         ],
         "${_Beta_Ver}": [
            ["style", "top", '42.08px'],
            ["style", "text-align", 'right'],
            ["style", "left", '826.68px'],
            ["style", "height", '62.609375px']
         ],
         "${_ThermalBut_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_BWNVBut_in}": [
            ["style", "top", '444px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '276px'],
            ["style", "width", '276px']
         ],
         "${_onclick4all}": [
            ["style", "top", '25px'],
            ["style", "left", '19px'],
            ["style", "overflow", 'visible']
         ],
         "${_Gen3But_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-215px'],
            ["style", "width", '975px']
         ],
         "${_autogatedNV}": [
            ["style", "height", '141px'],
            ["style", "top", '140.9px'],
            ["style", "left", '343px'],
            ["style", "width", '276px']
         ],
         "${_DaytimeBut_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '547.63px'],
            ["style", "width", '350px']
         ],
         "${_bwNV}": [
            ["style", "height", '141px'],
            ["style", "top", '422.9px'],
            ["style", "left", '482px'],
            ["style", "width", '276px']
         ],
         "${_allvideo}": [
            ["style", "top", '173px'],
            ["style", "opacity", '1'],
            ["style", "left", '121px']
         ],
         "${_digitalNV}": [
            ["style", "height", '141px'],
            ["style", "top", '563.9px'],
            ["style", "left", '482px'],
            ["style", "width", '347px']
         ],
         "${_onclick4all2}": [
            ["style", "overflow", 'visible']
         ],
         "${_AutogatedNVBut_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '548.3px'],
            ["style", "width", '350px']
         ],
         "${_AutogatedNVBut_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_Generation3PinnacleBut_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '548.3px'],
            ["style", "width", '350px']
         ],
         "${_DigitaLNV_out}": [
            ["style", "top", '2px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-212px'],
            ["style", "width", '975px']
         ],
         "${_AutogatedNVBut_out}": [
            ["style", "top", '2px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-215px'],
            ["style", "width", '975px']
         ],
         "${_generation1}": [
            ["style", "height", '141px'],
            ["style", "top", '704.9px'],
            ["style", "left", '67px'],
            ["style", "width", '825px']
         ],
         "${_DaytimeBut_out}": [
            ["style", "top", '2px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-215px'],
            ["style", "width", '975px']
         ],
         "${_DigitalNV_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-349.6px'],
            ["style", "width", '350px']
         ],
         "${_Gen3But_in}": [
            ["style", "top", '444px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '-1px'],
            ["style", "width", '276px']
         ],
         "${_Generation3PinnacleBut_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_DaytimeBut_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_Gen1But_in}": [
            ["style", "top", '726px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '-138px'],
            ["style", "width", '822.9833984375px']
         ],
         "${_BWNVBut_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '547.77px'],
            ["style", "width", '350px']
         ],
         "${_daytimeoptics}": [
            ["style", "height", '141px'],
            ["style", "top", '845.9px'],
            ["style", "left", '0px'],
            ["style", "width", '960px']
         ],
         "${_ThermalBut_in}": [
            ["style", "top", '21px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '206px'],
            ["style", "width", '139px']
         ],
         "${_BWNVBut_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_ThermalBut_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-212px'],
            ["style", "width", '975px']
         ],
         "${_AutogatedNVBut_in}": [
            ["style", "top", '161px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '135px'],
            ["style", "width", '276px']
         ],
         "${_Gen2But_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '546.3px'],
            ["style", "width", '350px']
         ],
         "${_generation2}": [
            ["style", "height", '141px'],
            ["style", "top", '563.9px'],
            ["style", "left", '135px'],
            ["style", "width", '347px']
         ],
         "${_DaytimeBut_in}": [
            ["style", "top", '866px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '-204px'],
            ["style", "width", '958px']
         ],
         "${_Gen1But_out}": [
            ["style", "top", '0px'],
            ["style", "height", '320px'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-213px'],
            ["style", "width", '975px']
         ],
         "${_ThermalBut_out_rightside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '547.98px'],
            ["style", "width", '350px']
         ],
         "${_Text}": [
            ["style", "top", '107.72px'],
            ["style", "height", '42.283332824707px'],
            ["style", "font-size", '12px'],
            ["style", "left", '708.32px'],
            ["style", "width", '260.69140625px']
         ],
         "${_generation3}": [
            ["style", "height", '141px'],
            ["style", "top", '422.9px'],
            ["style", "left", '206px'],
            ["style", "width", '276px']
         ],
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,1)'],
            ["style", "width", '975px'],
            ["style", "height", '1049px'],
            ["style", "overflow", 'hidden']
         ],
         "${_Generation3But_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_Gen2But_out_leftside}": [
            ["style", "top", '162px'],
            ["style", "height", '846px'],
            ["transform", "skewX", '-26deg'],
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '-350.31px'],
            ["style", "width", '350px']
         ],
         "${_DigitaLNV_in}": [
            ["style", "top", '585px'],
            ["style", "display", 'block'],
            ["style", "height", '141px'],
            ["style", "opacity", '0'],
            ["style", "left", '275px'],
            ["style", "width", '344.484375px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 2238,
         autoPlay: true,
         labels: {
            "reset": 0,
            "thermal_1": 250,
            "autogatednv_1": 500,
            "g3pinnacle_1": 806,
            "g3_1": 1100,
            "gen3_1": 1100,
            "bwnv_1": 1308,
            "gen2_1": 1500,
            "digitalnv_1": 1694,
            "gen1_1": 1938,
            "daytime_1": 2098
         },
         timeline: [
            { id: "eid204", tween: [ "style", "${_BWNVBut_out}", "display", 'block', { fromValue: 'none'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid508", tween: [ "style", "${_BWNVBut_out}", "display", 'none', { fromValue: 'block'}], position: 1433, duration: 0, easing: "easeOutQuad" },
            { id: "eid286", tween: [ "style", "${_Generation3PinnacleBut_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid958", tween: [ "style", "${_AutogatedNVBut_out}", "left", '-215px', { fromValue: '-215px'}], position: 582, duration: 0 },
            { id: "eid1138", tween: [ "style", "${_Generation3But_out_rightside}", "left", '547.77px', { fromValue: '547.77px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1128", tween: [ "style", "${_Generation3But_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1079", tween: [ "transform", "${_ThermalBut_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid185", tween: [ "style", "${_AutogatedNVBut_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid186", tween: [ "style", "${_AutogatedNVBut_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1180", tween: [ "style", "${_DigitalNV_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid214", tween: [ "style", "${_Gen1But_out}", "display", 'block', { fromValue: 'none'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid511", tween: [ "style", "${_Gen1But_out}", "display", 'none', { fromValue: 'block'}], position: 2014, duration: 0, easing: "easeOutQuad" },
            { id: "eid1187", tween: [ "style", "${_DigitalNV_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1115", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 806, duration: 0 },
            { id: "eid1116", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 979, duration: 0, easing: "easeOutQuad" },
            { id: "eid1199", tween: [ "transform", "${_Gen1But_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid1214", tween: [ "style", "${_Gen1But_out_rightside}", "left", '547.63px', { fromValue: '547.63px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid962", tween: [ "style", "${_BWNVBut_out}", "top", '0px', { fromValue: '0px'}], position: 1359, duration: 0 },
            { id: "eid1065", tween: [ "transform", "${_ThermalBut_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid923", tween: [ "style", "${_AutogatedNVBut_out}", "top", '2px', { fromValue: '2px'}], position: 582, duration: 0 },
            { id: "eid952", tween: [ "style", "${_ThermalBut_in}", "left", '206px', { fromValue: '206px'}], position: 0, duration: 0 },
            { id: "eid1173", tween: [ "style", "${_Gen2But_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1097", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "left", '548.3px', { fromValue: '548.3px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1106", tween: [ "transform", "${_Generation3PinnacleBut_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1218", tween: [ "style", "${_DaytimeBut_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 2098, duration: 0 },
            { id: "eid1219", tween: [ "style", "${_DaytimeBut_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 2238, duration: 0, easing: "easeOutQuad" },
            { id: "eid1212", tween: [ "transform", "${_Gen1But_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid947", tween: [ "style", "${_Gen3But_in}", "top", '444px', { fromValue: '444px'}], position: 0, duration: 0 },
            { id: "eid290", tween: [ "style", "${_Gen3But_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1072", tween: [ "style", "${_ThermalBut_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid1204", tween: [ "style", "${_Gen1But_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid1168", tween: [ "style", "${_Gen2But_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid963", tween: [ "style", "${_Gen2But_out}", "left", '-215px', { fromValue: '-215px'}], position: 1533, duration: 0 },
            { id: "eid219", tween: [ "style", "${_DaytimeBut_out}", "display", 'block', { fromValue: 'none'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid512", tween: [ "style", "${_DaytimeBut_out}", "display", 'none', { fromValue: 'block'}], position: 2238, duration: 0, easing: "easeOutQuad" },
            { id: "eid1135", tween: [ "transform", "${_Generation3But_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1145", tween: [ "style", "${_BWNVBut_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1057", tween: [ "style", "${_ThermalBut_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid1203", tween: [ "style", "${_Gen1But_out_leftside}", "left", '-349.6px', { fromValue: '-349.6px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid959", tween: [ "style", "${_Generation3PinnacleBut_out}", "left", '-213px', { fromValue: '-213px'}], position: 873, duration: 0 },
            { id: "eid1228", tween: [ "style", "${_DaytimeBut_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1150", tween: [ "style", "${_BWNVBut_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1107", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 806, duration: 0 },
            { id: "eid1108", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 979, duration: 0, easing: "easeOutQuad" },
            { id: "eid1091", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0 },
            { id: "eid1092", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 698, duration: 0, easing: "easeOutQuad" },
            { id: "eid1193", tween: [ "style", "${_DigitalNV_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1125", tween: [ "style", "${_Generation3But_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1224", tween: [ "style", "${_DaytimeBut_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 2098, duration: 0 },
            { id: "eid1225", tween: [ "style", "${_DaytimeBut_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 2238, duration: 0, easing: "easeOutQuad" },
            { id: "eid940", tween: [ "style", "${_Gen2But_in}", "left", '-71px', { fromValue: '-71px'}], position: 0, duration: 0 },
            { id: "eid960", tween: [ "style", "${_Gen3But_out}", "left", '-215px', { fromValue: '-215px'}], position: 1140, duration: 0 },
            { id: "eid564", tween: [ "style", "${_onclick4all}", "top", '25px', { fromValue: '25px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid1114", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid936", tween: [ "style", "${_DaytimeBut_in}", "left", '-204px', { fromValue: '-204px'}], position: 0, duration: 0 },
            { id: "eid1197", tween: [ "style", "${_DigitalNV_out_leftside}", "left", '-349.6px', { fromValue: '-349.6px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1063", tween: [ "style", "${_ThermalBut_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid1166", tween: [ "style", "${_Gen2But_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1131", tween: [ "style", "${_Generation3But_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 1100, duration: 0 },
            { id: "eid1132", tween: [ "style", "${_Generation3But_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 1211, duration: 0, easing: "easeOutQuad" },
            { id: "eid935", tween: [ "style", "${_DigitaLNV_in}", "opacity", '0', { fromValue: '0'}], position: 60, duration: 0 },
            { id: "eid1230", tween: [ "style", "${_DaytimeBut_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid926", tween: [ "style", "${_DigitaLNV_out}", "display", 'block', { fromValue: 'none'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid927", tween: [ "style", "${_DigitaLNV_out}", "display", 'none', { fromValue: 'block'}], position: 1834, duration: 0, easing: "easeOutQuad" },
            { id: "eid4", tween: [ "style", "${_ThermalBut_out}", "display", 'block', { fromValue: 'none'}], position: 250, duration: 0 },
            { id: "eid504", tween: [ "style", "${_ThermalBut_out}", "display", 'none', { fromValue: 'block'}], position: 398, duration: 0, easing: "easeOutQuad" },
            { id: "eid1060", tween: [ "style", "${_ThermalBut_out_rightside}", "left", '547.98px', { fromValue: '547.98px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid7", tween: [ "style", "${_ThermalBut_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid3", tween: [ "style", "${_ThermalBut_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid209", tween: [ "style", "${_Gen2But_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid210", tween: [ "style", "${_Gen2But_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid930", tween: [ "style", "${_DigitaLNV_out}", "top", '2px', { fromValue: '2px'}], position: 1724, duration: 0 },
            { id: "eid201", tween: [ "style", "${_Gen3But_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid202", tween: [ "style", "${_Gen3But_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid961", tween: [ "style", "${_BWNVBut_out}", "left", '-213px', { fromValue: '-213px'}], position: 1359, duration: 0 },
            { id: "eid1148", tween: [ "style", "${_BWNVBut_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 1308, duration: 0 },
            { id: "eid1149", tween: [ "style", "${_BWNVBut_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 1433, duration: 0, easing: "easeOutQuad" },
            { id: "eid967", tween: [ "style", "${_DaytimeBut_out}", "left", '-215px', { fromValue: '-215px'}], position: 2151, duration: 0 },
            { id: "eid1053", tween: [ "style", "${_ThermalBut_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 250, duration: 0 },
            { id: "eid1066", tween: [ "style", "${_ThermalBut_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 398, duration: 0, easing: "easeOutQuad" },
            { id: "eid1110", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "left", '548.3px', { fromValue: '548.3px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid197", tween: [ "style", "${_Generation3PinnacleBut_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid198", tween: [ "style", "${_Generation3PinnacleBut_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1082", tween: [ "transform", "${_AutogatedNVBut_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid921", tween: [ "style", "${_Generation3PinnacleBut_out}", "top", '0px', { fromValue: '0px'}], position: 873, duration: 0 },
            { id: "eid1154", tween: [ "style", "${_BWNVBut_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1186", tween: [ "style", "${_DigitalNV_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1226", tween: [ "style", "${_DaytimeBut_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1222", tween: [ "style", "${_DaytimeBut_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1139", tween: [ "style", "${_BWNVBut_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1087", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid956", tween: [ "style", "${_ThermalBut_out}", "left", '-212px', { fromValue: '-212px'}], position: 323, duration: 0 },
            { id: "eid1074", tween: [ "style", "${_ThermalBut_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 250, duration: 0 },
            { id: "eid1075", tween: [ "style", "${_ThermalBut_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 398, duration: 0, easing: "easeOutQuad" },
            { id: "eid1220", tween: [ "style", "${_DaytimeBut_out_rightside}", "left", '547.63px', { fromValue: '547.63px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1175", tween: [ "style", "${_Gen2But_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1163", tween: [ "transform", "${_Gen2But_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1112", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1207", tween: [ "style", "${_Gen1But_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid948", tween: [ "style", "${_Generation3PinnacleBut_in}", "left", '68px', { fromValue: '68px'}], position: 0, duration: 0 },
            { id: "eid1088", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1277", tween: [ "style", "${_allvideo}", "opacity", '1', { fromValue: '1'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid1205", tween: [ "style", "${_Gen1But_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid1216", tween: [ "transform", "${_DaytimeBut_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid208", tween: [ "style", "${_Gen2But_out}", "display", 'block', { fromValue: 'none'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid509", tween: [ "style", "${_Gen2But_out}", "display", 'none', { fromValue: 'block'}], position: 1629, duration: 0, easing: "easeOutQuad" },
            { id: "eid1095", tween: [ "transform", "${_AutogatedNVBut_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1109", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid955", tween: [ "style", "${_BWNVBut_in}", "top", '444px', { fromValue: '444px'}], position: 0, duration: 0 },
            { id: "eid1142", tween: [ "style", "${_BWNVBut_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 1308, duration: 0 },
            { id: "eid1143", tween: [ "style", "${_BWNVBut_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 1433, duration: 0, easing: "easeOutQuad" },
            { id: "eid1169", tween: [ "style", "${_Gen2But_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid937", tween: [ "style", "${_DaytimeBut_in}", "top", '866px', { fromValue: '866px'}], position: 0, duration: 0 },
            { id: "eid1182", tween: [ "style", "${_DigitalNV_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1119", tween: [ "transform", "${_Generation3PinnacleBut_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1076", tween: [ "style", "${_ThermalBut_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid1221", tween: [ "style", "${_DaytimeBut_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid932", tween: [ "style", "${_Gen1But_out}", "top", '0px', { fromValue: '0px'}], position: 1978, duration: 0 },
            { id: "eid220", tween: [ "style", "${_DaytimeBut_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid221", tween: [ "style", "${_DaytimeBut_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1208", tween: [ "style", "${_Gen1But_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 1905, duration: 0 },
            { id: "eid1209", tween: [ "style", "${_Gen1But_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 2014, duration: 0, easing: "easeOutQuad" },
            { id: "eid1194", tween: [ "transform", "${_DigitalNV_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid897", tween: [ "style", "${_DigitaLNV_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid896", tween: [ "style", "${_DigitaLNV_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1140", tween: [ "transform", "${_BWNVBut_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1123", tween: [ "style", "${_Generation3But_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 1100, duration: 0 },
            { id: "eid1124", tween: [ "style", "${_Generation3But_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 1211, duration: 0, easing: "easeOutQuad" },
            { id: "eid1126", tween: [ "style", "${_Generation3But_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1141", tween: [ "style", "${_BWNVBut_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1094", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid287", tween: [ "style", "${_AutogatedNVBut_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid206", tween: [ "style", "${_BWNVBut_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid207", tween: [ "style", "${_BWNVBut_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1153", tween: [ "transform", "${_BWNVBut_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1217", tween: [ "style", "${_DaytimeBut_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1086", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1090", tween: [ "style", "${_AutogatedNVBut_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1198", tween: [ "style", "${_Gen1But_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid1185", tween: [ "style", "${_DigitalNV_out_rightside}", "left", '546.3px', { fromValue: '546.3px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1189", tween: [ "style", "${_DigitalNV_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1127", tween: [ "style", "${_Generation3But_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1152", tween: [ "style", "${_BWNVBut_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1083", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0 },
            { id: "eid1084", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 698, duration: 0, easing: "easeOutQuad" },
            { id: "eid1176", tween: [ "transform", "${_Gen2But_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1167", tween: [ "style", "${_Gen2But_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1080", tween: [ "style", "${_ThermalBut_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid1271", tween: [ "style", "${_allvideo}", "left", '122px', { fromValue: '121px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid957", tween: [ "style", "${_ThermalBut_out}", "top", '0px', { fromValue: '0px'}], position: 323, duration: 0 },
            { id: "eid1061", tween: [ "style", "${_ThermalBut_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid188", tween: [ "style", "${_AutogatedNVBut_out}", "display", 'block', { fromValue: 'none'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid505", tween: [ "style", "${_AutogatedNVBut_out}", "display", 'none', { fromValue: 'block'}], position: 698, duration: 0, easing: "easeOutQuad" },
            { id: "eid953", tween: [ "style", "${_ThermalBut_in}", "top", '21px', { fromValue: '21px'}], position: 0, duration: 0 },
            { id: "eid1215", tween: [ "style", "${_DaytimeBut_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1181", tween: [ "transform", "${_DigitalNV_out_rightside}", "skewX", '26deg', { fromValue: '26deg'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid950", tween: [ "style", "${_AutogatedNVBut_in}", "left", '135px', { fromValue: '135px'}], position: 0, duration: 0 },
            { id: "eid928", tween: [ "style", "${_DigitaLNV_out}", "height", '320px', { fromValue: '320px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1200", tween: [ "style", "${_Gen1But_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid1201", tween: [ "style", "${_Gen1But_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 1905, duration: 0 },
            { id: "eid1202", tween: [ "style", "${_Gen1But_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 2014, duration: 0, easing: "easeOutQuad" },
            { id: "eid291", tween: [ "style", "${_BWNVBut_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1081", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid938", tween: [ "style", "${_Gen1But_in}", "left", '-138px', { fromValue: '-138px'}], position: 0, duration: 0 },
            { id: "eid212", tween: [ "style", "${_Gen1But_in}", "display", 'block', { fromValue: 'block'}], position: 0, duration: 0 },
            { id: "eid213", tween: [ "style", "${_Gen1But_in}", "display", 'none', { fromValue: 'block'}], position: 182, duration: 0 },
            { id: "eid1078", tween: [ "style", "${_ThermalBut_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 250, duration: 0, easing: "easeOutQuad" },
            { id: "eid195", tween: [ "style", "${_Generation3PinnacleBut_out}", "display", 'block', { fromValue: 'none'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid506", tween: [ "style", "${_Generation3PinnacleBut_out}", "display", 'none', { fromValue: 'block'}], position: 979, duration: 0, easing: "easeOutQuad" },
            { id: "eid951", tween: [ "style", "${_AutogatedNVBut_in}", "top", '161px', { fromValue: '161px'}], position: 0, duration: 0 },
            { id: "eid1229", tween: [ "transform", "${_DaytimeBut_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1190", tween: [ "style", "${_DigitalNV_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 1694, duration: 0 },
            { id: "eid1191", tween: [ "style", "${_DigitalNV_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 1834, duration: 0, easing: "easeOutQuad" },
            { id: "eid1121", tween: [ "style", "${_Generation3But_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1130", tween: [ "style", "${_Generation3But_out_rightside}", "height", '846px', { fromValue: '846px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1162", tween: [ "style", "${_Gen2But_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid285", tween: [ "style", "${_Gen2But_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid946", tween: [ "style", "${_Gen3But_in}", "left", '-1px', { fromValue: '-1px'}], position: 0, duration: 0 },
            { id: "eid284", tween: [ "style", "${_ThermalBut_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid289", tween: [ "style", "${_Gen1But_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1164", tween: [ "style", "${_Gen2But_out_leftside}", "display", 'block', { fromValue: 'none'}], position: 1500, duration: 0 },
            { id: "eid1165", tween: [ "style", "${_Gen2But_out_leftside}", "display", 'none', { fromValue: 'block'}], position: 1629, duration: 0, easing: "easeOutQuad" },
            { id: "eid949", tween: [ "style", "${_Generation3PinnacleBut_in}", "top", '303px', { fromValue: '303px'}], position: 0, duration: 0 },
            { id: "eid1105", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "top", '162px', { fromValue: '162px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1118", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "width", '350px', { fromValue: '350px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid965", tween: [ "style", "${_Gen1But_out}", "left", '-213px', { fromValue: '-213px'}], position: 1938, duration: 0 },
            { id: "eid1134", tween: [ "style", "${_Generation3But_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid1120", tween: [ "style", "${_Generation3PinnacleBut_out_leftside}", "left", '-350.31px', { fromValue: '-350.31px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1144", tween: [ "style", "${_BWNVBut_out_rightside}", "left", '547.77px', { fromValue: '547.77px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid917", tween: [ "style", "${_Gen2But_out}", "top", '0px', { fromValue: '0px'}], position: 1533, duration: 0 },
            { id: "eid934", tween: [ "style", "${_DaytimeBut_out}", "top", '2px', { fromValue: '2px'}], position: 2151, duration: 0 },
            { id: "eid941", tween: [ "style", "${_Gen2But_in}", "top", '584px', { fromValue: '584px'}], position: 0, duration: 0 },
            { id: "eid1146", tween: [ "style", "${_BWNVBut_out_leftside}", "top", '162px', { fromValue: '162px'}], position: 1308, duration: 0, easing: "easeOutQuad" },
            { id: "eid1211", tween: [ "style", "${_Gen1But_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 1905, duration: 0, easing: "easeOutQuad" },
            { id: "eid939", tween: [ "style", "${_Gen1But_in}", "top", '726px', { fromValue: '726px'}], position: 0, duration: 0 },
            { id: "eid200", tween: [ "style", "${_Gen3But_out}", "display", 'block', { fromValue: 'none'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid507", tween: [ "style", "${_Gen3But_out}", "display", 'none', { fromValue: 'block'}], position: 1211, duration: 0, easing: "easeOutQuad" },
            { id: "eid1171", tween: [ "style", "${_Gen2But_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 1500, duration: 0 },
            { id: "eid1172", tween: [ "style", "${_Gen2But_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 1629, duration: 0, easing: "easeOutQuad" },
            { id: "eid954", tween: [ "style", "${_BWNVBut_in}", "left", '276px', { fromValue: '276px'}], position: 0, duration: 0 },
            { id: "eid1085", tween: [ "style", "${_AutogatedNVBut_out_leftside}", "height", '846px', { fromValue: '846px'}], position: 500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1183", tween: [ "style", "${_DigitalNV_out_rightside}", "display", 'block', { fromValue: 'none'}], position: 1694, duration: 0 },
            { id: "eid1184", tween: [ "style", "${_DigitalNV_out_rightside}", "display", 'none', { fromValue: 'block'}], position: 1834, duration: 0, easing: "easeOutQuad" },
            { id: "eid1122", tween: [ "transform", "${_Generation3But_out_leftside}", "skewX", '-26deg', { fromValue: '-26deg'}], position: 1100, duration: 0, easing: "easeOutQuad" },
            { id: "eid964", tween: [ "style", "${_DigitaLNV_out}", "left", '-212px', { fromValue: '-212px'}], position: 1724, duration: 0 },
            { id: "eid283", tween: [ "style", "${_DaytimeBut_out}", "height", '320px', { fromValue: '320px'}], position: 2098, duration: 0, easing: "easeOutQuad" },
            { id: "eid1111", tween: [ "style", "${_Generation3PinnacleBut_out_rightside}", "width", '350px', { fromValue: '350px'}], position: 806, duration: 0, easing: "easeOutQuad" },
            { id: "eid1179", tween: [ "style", "${_Gen2But_out_rightside}", "left", '546.3px', { fromValue: '546.3px'}], position: 1500, duration: 0, easing: "easeOutQuad" }         ]
      }
   }
},
"onclick4all": {
   version: "1.0.0",
   minimumCompatibleVersion: "0.1.7",
   build: "1.0.0.185",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
   dom: [
   {
      id: 'green_full',
      type: 'image',
      rect: ['-13px','-5px','963px','969px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/green_full.png','0px','0px']
   },
   {
      id: 'grey_full',
      type: 'image',
      rect: ['-13px','-5px','963px','989px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/grey_full.png','0px','0px']
   },
   {
      id: 'Gen1_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2',
         text: 'Night Vision Generation 1 most perfect low light viewing capability for first time users.  Gen 1 Night vision  offers great value and decent performance per any application, Hunting, wild life observation, home security, and just about every night time application.  1st Generation Night Vision contains a vacuum image intensifier tube tube allowing 100 yards of night time viewing.   We offer a wide variety of brands of Generation One Night Vision allowing you to choose from.  If you are looking for an affordable and ideal night vision device for home and leisure use,  G1 Night vision  is right for you. <br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','469px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_Title',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1',
         text: '- The image you see may be slightly blurry around the edges, this is known as  Geometric Distortion<br>- When you turn a 1st generation unit off it may glow green for some time<br>- Photocathode: Vacuum Image Intensifier Tube<br>- Resolution from 25 to 30 lp/mm<br>- Tube Life Hour: 2,500+ <br>- Distance: 75-100 yards<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_Title',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_Placeholder',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','69px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'Title',
         text: 'Generation 1',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'AutogatedNV_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy',
         text: 'By removing ion barrier film and “Gating” the system Autogated Night Vision tubes demonstrates substantial increases in target detection range and resolution, particularly at extremely low light levels.  The use of Autogated night vision and filmless technology inverting image intensifier tubes improved night operational effectiveness for users of night vision devices.  The filmless micro channel plate provides a higher signal to noise ratio than standard 3rd Generation.  Autogated Gen contains an autogated power supply further improves image resolution under high light conditions and reduced halo effect that minimized interference from bring light sources.  For professional operations and Top-of-the-line performance enthusiasts, Auto-gated Night vision offers technological improvement and superior performance in the night vision market. None Pinnacle tubes are available for export.  A signed export compliance and end use statement is required prior to shipping of these units.<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','469px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy',
         text: '- Autogated Power Supply<br>- Increase in Performance: 50% Increase in Performance from Generation 3 <br>- Photocathode: Filmless GaAs<br>- Resolution: 64-72 lp/mm<br>- Signal to Noise Ratio: 25-30<br>- Tube Life Hours: 10,000+<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','69px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy',
         text: 'Autogated NV',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'G3Pinnacle_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy2',
         text: 'Generation 3 Pinnacle Night Vision units with 3 Pinnacle designation use IIT Pinnacle image intensifier tubes.  ITT is industry leading ITT Pinnacle image tubes utilized a gated power supply providing truly outstanding performance in high-light or light-polluted areas, such as urban environments. Generation 3 Pinnacle night vision tubes with gated power supply minimized any “halo” effect.  Using 3rd Generation have a resolution of 64-72 lp/mm and typical signal to noise ratio of 26.  All Night Vision devices utilizing Pinnacle image intensifier tubes come with ITT data sheet.  None Pinnacle tubes are available for export.  A signed export compliance and end use statement is required prior to shipping of these units. <br><br>*Pinnacle is a registered trademark of ITT Night Vision<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','469px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy2',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy2',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy2',
         text: '- Increase In performance in 125% in performance from Generation 2 <br>- Photocathode: Gallium Arsenide<br>- Resolution: 64-72 lp/mm<br>- Signal to Noise Ratio: 25-30<br>- Tube Life Hours: 10,000+ <br>- Distance: 350+ Yards<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy2',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy2',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy2',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy2',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy2',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','46px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy2',
         text: 'Generation 3<br>Pinnacle',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'G3_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy3',
         text: 'In addition a sensitive chemical, Gallium Arsenide to the photocathode a sharper and brighter image has been achieved over 2nd Generation Night Vision  units.  Generation 3 Night vision  added an ion battier film to increase tube life.  Generation 3 night vision provides the user with excellent low light performance.  Standard ITT and L3 3rd Generation tubes are of the highest quality.  They have a micro channel plate, GaAs photocathode, and completely self-contained integral high-voltage power supply.  Gen 3 night vision tubes provide a combined increase in resolution, signal to noise and photosensitivity over tubes with a multi-alkali photocathode.  3rd Night Vision Generation is utilized by USA government agencies, Law Enforcement,  homeland security, and high end enthusiasts.<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','469px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy3',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy3',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy3',
         text: '- Increase in performance: Increase 100% in performance from Generation 2 <br>- Photocathode: Gallium Arsenide<br>- Resolution: 64 lp/mm<br>- Signal-to-Noise Ration: 22 Typical<br>- Tube Life Hours: 10,000+ <br>- Distance: 300+ Yards<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy3',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy3',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy3',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy3',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy3',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','73px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy3',
         text: 'Generation 3',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'BWNV_Content_Group',
      type: 'group',
      rect: ['160','298','621','623','auto','auto'],
      c: [
      {
         rect: ['12px','435px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy4',
         text: 'Green phosphors plate has been develop due to research, green color perceived faster with human eyes.  Recently Night Vision cutting edge technology released White Phosphor Technology.  Studies show that night time scenes appear remarkably more natural in black and white versus the usual green.  Black and White Phosphor Gen provides clearer information about contrast, shapes and shadows.  Some people refer it to “Future of Night Vision”<br><br>White Phosphor Generation performance characteristics are on a par or better then the green night vision viewing.  When compared with common green night vision, especially in an urban environment it demonstrates sharper image, great depth perception, and you will be able to detect any object faster than any other night vision.  Revolutionary technology for white phosphor technology provides an extraordinary solution per any night time operations.<br><br>Auto-Gated White Phosphor Technology features new White Phosphor “Chrome” technology as well as manual gain control which allows the user to increase or decrease image tube brightness or greater image contrast in varying light conditions.  Autogated White Phosphor technology is auto-gated Generation 3 image tube in high performance, mil spec, and designed to multiple applications. None Pinnacle tubes are available for export.  A signed export compliance and end use statement is required prior to shipping of these units.  <br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','407px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy4',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','383px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy4',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['42px','283px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy4',
         text: '- White Phosphorus Plate<br>- Increase in Performance: 50% from Generation 2<br>- Photocathode: Multi Alkali<br>- Resolution: 60-72<br>- Signal-to-Noise Ratio: 25<br>- Tube Life Hour: 5,000+<br>- Distance: 250+ Yards',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['42px','283px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy5',
         text: '- White Phosphorus Plate<br>- Increase in Performance: 100% from Generation 2<br>- Photocathode: Filmless Autogated GaAs<br>- Resolution: 64-74<br>- Signal-to Noise Ratio: 25-30<br>- Distance: 350+ Yards',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['42px','283px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Content_Feature_Cat1Copy6',
         text: 'Auto-gated White Phoshpor Technology',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['42px','283px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Content_Feature_Cat1Copy7',
         text: 'White Phosphor Technology',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','251px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy4',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','240px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy4',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','45px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy4',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','164px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy4',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','120px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy4',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','0px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy4',
         text: 'Black and White NV',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'G2_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy5',
         text: 'In addition of a micro-channel plate, Generation 2 Night Vision commonly referred to as  MCP.  The MCP works as an electron amplifier and is placed directly behind the photocathode.  Gen 2 Night vision micro channel plate (MSP) consist of millions of short parallel glass tubes.  When the electron pass through these short tubes, thousands more electrons are released.  This additional process provides Generation 2 night vision units to amplify the light many more times then 1st generation.  G2 Night vision tubes are high quality with exceptional brightness and resolution.  Each tube has a micro channel plate, multi-alkaline photocathode with built-in power supply.  Night Vision Generation 2 still is reasonably priced enough for most budgets.  G2 NV is a must-have for all hobbyist and enthusiast-level night vision.  If you are looking for a top technological performance for leisure, security, and professional recreational usage, there will be no better value than Gen 2.<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','469px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy5',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy5',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy8',
         text: '- Increase in performance : Increase 150% in performance from Generation 1 <br>- Photocathode: Multi-Alkali<br>- Resolution: 40-45 lp/mm<br>- Signal-to-Noise Ratio: from 12-20<br>- Tube Life Hour: 5,000+ <br>- Distance: 200+ Yards<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy5',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy5',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy5',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy5',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy5',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','73px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy5',
         text: 'Generation 2',
         align: 'center',
         type: 'text'
      }]
   },
   {
      id: 'DigitalNV_Content_Group',
      type: 'group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         rect: ['12px','508px','591px','197px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Desrciption2Copy6',
         text: 'As opposed to analog Night Vision devices, the Digital Night Vision  offers unique advantages.  First you don’t have to worry about lens cap staying on during the day, its digital! Second, you can record and extract images and videos.  Third it doesn’t have tube life hours, so it could last as long as possible.  Digital Night Vision offers fine image quality and resolution.  With windage and elevation by pixels, very precise shooting experience.  Higher performance than a 2nd generation night vision unit, digital night vision provides ultimate performance for all technological advancement &amp; value seeker.<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['14px','474px','auto','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         id: 'Description_TitleCopy6',
         text: 'Description',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['0px','456px','621px','1px','auto','auto'],
         id: 'Line_Spacer2Copy6',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['61px','370px','229px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Content_Feature_Cat1Copy9',
         text: '- Can operate day/night<br>- Highly Sensitive CCD Array<br>- External Power Supply<br>- Increase in performance: Increase 150% in performance from Generation 1<br>- Resolution, Pixels: 640x480<br>- Distance: 200+ Yards<br>- White Phosphor Technology<br>',
         align: 'left',
         type: 'text'
      },
      {
         rect: ['196px','324px','229px','50px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         id: 'Specs_Features_TitleCopy6',
         text: 'Specs and Features',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         stroke: [1,'rgb(0, 0, 0)','none'],
         id: 'Line_Spacer1Copy6',
         opacity: 0.35,
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         rect: ['150px','118px','320px','180px','auto','auto'],
         id: 'Image_PlaceholderCopy6',
         stroke: [0,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(192,192,192,1)']
      },
      {
         rect: ['184px','237px','250px','auto','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         id: 'Text14Copy6',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['150px','193px','320px','44px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         id: 'Text13Copy6',
         text: 'Video/Image Placeholder',
         align: 'center',
         type: 'text'
      },
      {
         rect: ['173px','73px','279px','42px','auto','auto'],
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         id: 'TitleCopy6',
         text: 'Digital NV',
         align: 'center',
         type: 'text'
      }]
   }],
   symbolInstances: [
   ]
   },
   states: {
      "Base State": {
         "${_Desrciption2}": [
            ["style", "top", '499.94px'],
            ["style", "font-size", '12px'],
            ["style", "height", '196.5px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "width", '590.95001220703px']
         ],
         "${_Text14Copy3}": [
            ["style", "top", '236.62px'],
            ["style", "font-size", '12px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "width", '250px']
         ],
         "${_Desrciption2Copy4}": [
            ["style", "top", '434px'],
            ["style", "font-size", '12px'],
            ["style", "height", '196.5px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "width", '590.95001220703px']
         ],
         "${_Image_PlaceholderCopy}": [
            ["style", "top", '118.02px'],
            ["style", "height", '180px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_TitleCopy2}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '46.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '279.27380371094px']
         ],
         "${_Text14Copy4}": [
            ["style", "top", '163.62px'],
            ["style", "width", '250px'],
            ["style", "height", '28px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "font-size", '12px']
         ],
         "${_Content_Feature_Cat1Copy7}": [
            ["style", "top", '272px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '17px'],
            ["style", "font-weight", '700'],
            ["style", "left", '37px'],
            ["style", "width", '276px']
         ],
         "${_Specs_Features_TitleCopy6}": [
            ["style", "top", '325px'],
            ["style", "text-align", 'center'],
            ["style", "width", '228.5333404541px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "font-size", '16px']
         ],
         "${_Text13Copy6}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "width", '320px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "font-size", '21px']
         ],
         "${_Line_Spacer2}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '0.02px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Text13Copy4}": [
            ["style", "top", '119.62px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '21px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Line_Spacer1Copy6}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-style", 'none'],
            ["style", "border-width", '1px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "left", '67.8px'],
            ["style", "top", '313.17px']
         ],
         "${_Specs_Features_TitleCopy2}": [
            ["style", "top", '324.43px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '16px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "width", '228.5333404541px']
         ],
         "${_TitleCopy6}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '73.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "width", '279.27380371094px'],
            ["style", "text-decoration", 'none'],
            ["style", "height", '42px']
         ],
         "${_Text14Copy5}": [
            ["style", "top", '236.62px'],
            ["style", "width", '250px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "font-size", '12px']
         ],
         "${_Image_PlaceholderCopy3}": [
            ["style", "top", '118.02px'],
            ["style", "height", '180px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Content_Feature_Cat1Copy6}": [
            ["style", "top", '272px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.099998474121px'],
            ["style", "font-weight", '700'],
            ["style", "left", '318px'],
            ["style", "width", '287px']
         ],
         "${_AutogatedNV_Content_Group}": [
            ["style", "opacity", '0.000000']
         ],
         "${_Description_TitleCopy3}": [
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '469.12px'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Content_Feature_Cat1Copy9}": [
            ["style", "top", '349px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '101px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '538px']
         ],
         "${_Desrciption2Copy5}": [
            ["style", "top", '499.94px'],
            ["style", "font-size", '12px'],
            ["style", "height", '196.5px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "width", '598.66485595703px']
         ],
         "${_Line_Spacer1Copy3}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '67.8px'],
            ["style", "top", '313.17px']
         ],
         "${_Content_Feature_Cat1Copy5}": [
            ["style", "top", '289px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.099998474121px'],
            ["style", "font-weight", '400'],
            ["style", "left", '318px'],
            ["style", "width", '297.76483154297px']
         ],
         "${_Thermal_Content_Group}": [
            ["style", "top", '224.84px'],
            ["style", "opacity", '0'],
            ["style", "left", '160px']
         ],
         "${_Content_Feature_Cat1Copy4}": [
            ["style", "top", '289px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.099998474121px'],
            ["style", "font-weight", '400'],
            ["style", "left", '37.07px'],
            ["style", "width", '278.93334960938px']
         ],
         "${_Line_Spacer2Copy}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '0.02px'],
            ["style", "border-style", 'none'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Text13}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '21px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Line_Spacer1Copy2}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '313.17px'],
            ["style", "left", '67.8px'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35']
         ],
         "${_Content_Feature_Cat1Copy}": [
            ["style", "top", '354px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.103385925293px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '547.79998779297px']
         ],
         "${_Content_Feature_Cat1Copy2}": [
            ["style", "top", '354px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.103385925293px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '547.79998779297px']
         ],
         "${_Line_Spacer2Copy5}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '0.02px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Content_Feature_Cat1}": [
            ["style", "top", '354px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.103385925293px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '547.79998779297px']
         ],
         "${_Text13Copy}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "width", '320px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "font-size", '21px']
         ],
         "${_Line_Spacer1Copy4}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '240.17px'],
            ["style", "left", '67.8px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "border-style", 'none']
         ],
         "${_Text14Copy}": [
            ["style", "top", '236.62px'],
            ["style", "font-size", '12px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "width", '250px']
         ],
         "${_Line_Spacer1Copy5}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '313.17px'],
            ["style", "left", '67.8px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "border-style", 'none']
         ],
         "${_Text14Copy2}": [
            ["style", "top", '236.62px'],
            ["style", "width", '250px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "font-size", '12px']
         ],
         "${_Description_Title}": [
            ["style", "top", '469.12px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Text14}": [
            ["style", "top", '236.62px'],
            ["style", "width", '250px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "font-size", '12px']
         ],
         "${_Specs_Features_TitleCopy}": [
            ["style", "top", '324.43px'],
            ["style", "text-align", 'center'],
            ["style", "width", '228.5333404541px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "font-size", '16px']
         ],
         "${_Description_TitleCopy4}": [
            ["style", "top", '407.12px'],
            ["style", "height", '18px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Text14Copy6}": [
            ["style", "top", '236.62px'],
            ["style", "font-size", '12px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "width", '250px']
         ],
         "${_Desrciption2Copy6}": [
            ["style", "top", '505px'],
            ["style", "width", '598.66485595703px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '196.5px'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "font-size", '12px']
         ],
         "${_Description_TitleCopy5}": [
            ["style", "top", '469.12px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Specs_Features_TitleCopy5}": [
            ["style", "top", '324.43px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '16px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "width", '228.5333404541px']
         ],
         "${_Content_Feature_Cat1Copy8}": [
            ["style", "top", '354px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.103385925293px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '547.79998779297px']
         ],
         "${_Description_TitleCopy}": [
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '469.12px'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Specs_Features_Title}": [
            ["style", "top", '324.43px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '16px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "width", '228.5333404541px']
         ],
         "${_Line_Spacer2Copy2}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '0.02px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Image_Placeholder}": [
            ["style", "height", '180px'],
            ["style", "top", '118.02px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_BWNV_Content_Group}": [
            ["style", "opacity", '0']
         ],
         "${_Description_TitleCopy2}": [
            ["style", "top", '469.12px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Text17Copy}": [
            ["style", "top", '223.4px'],
            ["style", "font-size", '36px'],
            ["style", "left", '396px'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "font-weight", '700'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '168px']
         ],
         "${_Line_Spacer2Copy6}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '0.02px'],
            ["style", "border-style", 'none'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_TitleCopy5}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '73.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '279.27380371094px']
         ],
         "${_Gen1_Content_Group}": [
            ["style", "opacity", '0']
         ],
         "${_TitleCopy}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '69.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "width", '279.27380371094px'],
            ["style", "text-decoration", 'none'],
            ["style", "height", '42px']
         ],
         "${_G2_Content_Group}": [
            ["style", "opacity", '0.000000']
         ],
         "${_Description_TitleCopy6}": [
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '474.12px'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Image_PlaceholderCopy5}": [
            ["style", "height", '180px'],
            ["style", "top", '118.02px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Desrciption2Copy2}": [
            ["style", "top", '499.94px'],
            ["style", "font-size", '12px'],
            ["style", "height", '196.5px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "width", '590.95001220703px']
         ],
         "${_Line_Spacer1Copy}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-style", 'none'],
            ["style", "border-width", '1px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "left", '67.8px'],
            ["style", "top", '313.17px']
         ],
         "${_Line_Spacer2Copy4}": [
            ["style", "top", '396.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '0.02px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Specs_Features_TitleCopy3}": [
            ["style", "top", '324.43px'],
            ["style", "text-align", 'center'],
            ["style", "width", '228.5333404541px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "font-size", '16px']
         ],
         "${symbolSelector}": [
            ["style", "height", '987px'],
            ["style", "width", '958px']
         ],
         "${_Content_Feature_Cat1Copy3}": [
            ["style", "top", '354px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '88.103385925293px'],
            ["style", "font-weight", '400'],
            ["style", "left", '42px'],
            ["style", "width", '547.79998779297px']
         ],
         "${_TitleCopy4}": [
            ["style", "font-weight", '700'],
            ["style", "left", '173px'],
            ["style", "font-size", '28px'],
            ["style", "top", '0px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '279.27380371094px']
         ],
         "${_DigitalNV_Content_Group}": [
            ["style", "opacity", '0.000000']
         ],
         "${_G3_Content_Group}": [
            ["style", "opacity", '0.000000']
         ],
         "${_Text13Copy2}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '21px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Line_Spacer1}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '313.17px'],
            ["style", "left", '67.8px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "border-style", 'none']
         ],
         "${_Title}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '69.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '279.27380371094px']
         ],
         "${_grey_full}": [
            ["style", "top", '-5px'],
            ["style", "height", '989px'],
            ["style", "opacity", '0'],
            ["style", "left", '-13px'],
            ["style", "width", '963px']
         ],
         "${_Specs_Features_TitleCopy4}": [
            ["style", "top", '247px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '16px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "width", '228.5333404541px']
         ],
         "${_Image_PlaceholderCopy4}": [
            ["style", "height", '180px'],
            ["style", "top", '45.02px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_G3Pinnacle_Content_Group}": [
            ["style", "opacity", '0.000000']
         ],
         "${_Text13Copy5}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '21px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Image_PlaceholderCopy2}": [
            ["style", "height", '180px'],
            ["style", "top", '118.02px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_TitleCopy3}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '73.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "width", '279.27380371094px'],
            ["style", "text-decoration", 'none'],
            ["style", "height", '42px']
         ],
         "${_Desrciption2Copy}": [
            ["style", "top", '499.94px'],
            ["style", "width", '590.95001220703px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '196.5px'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "font-size", '12px']
         ],
         "${_Desrciption2Copy3}": [
            ["style", "top", '499.94px'],
            ["style", "width", '590.95001220703px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '196.5px'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "font-size", '12px']
         ],
         "${_green_full}": [
            ["style", "top", '-5px'],
            ["style", "height", '990px'],
            ["style", "opacity", '0'],
            ["style", "left", '-13px'],
            ["style", "width", '963px']
         ],
         "${_Text13Copy3}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "width", '320px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "font-size", '21px']
         ],
         "${_Image_PlaceholderCopy6}": [
            ["style", "top", '118.02px'],
            ["style", "height", '180px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Line_Spacer2Copy3}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '0.02px'],
            ["style", "border-style", 'none'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "width", '621.40728759766px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 15956,
         autoPlay: false,
         labels: {
            "gen1_in": 250,
            "gen1_out": 1376,
            "autogatednv_in": 2500,
            "autogatednv_out": 3626,
            "g3pinnacle_in": 5000,
            "g3pinnacle_out": 6000,
            "gen3_in": 7000,
            "gen3_out": 8000,
            "bwnv_in": 9390,
            "bwnv_out": 10516,
            "gen2_in": 11750,
            "gen2_out": 12876
         },
         timeline: [
            { id: "eid758", tween: [ "style", "${_Desrciption2Copy5}", "width", '598.66485595703px', { fromValue: '598.66485595703px'}], position: 12638, duration: 0, easing: "easeOutQuad" },
            { id: "eid788", tween: [ "style", "${_Desrciption2Copy6}", "top", '505px', { fromValue: '505px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid752", tween: [ "color", "${_Desrciption2Copy5}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid753", tween: [ "color", "${_Desrciption2Copy5}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid82", tween: [ "style", "${_Thermal_Content_Group}", "opacity", '1', { fromValue: '0'}], position: 750, duration: 388, easing: "easeOutQuad" },
            { id: "eid85", tween: [ "style", "${_Thermal_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 1376, duration: 374, easing: "easeOutQuad" },
            { id: "eid616", tween: [ "style", "${_Content_Feature_Cat1Copy3}", "height", '88.099998474121px', { fromValue: '88.103385925293px'}], position: 8000, duration: 0, easing: "easeOutQuad" },
            { id: "eid549", tween: [ "style", "${_Content_Feature_Cat1Copy}", "left", '42px', { fromValue: '42px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid744", tween: [ "style", "${_Specs_Features_TitleCopy5}", "height", '18px', { fromValue: '18px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid745", tween: [ "style", "${_Specs_Features_TitleCopy5}", "height", '18px', { fromValue: '18px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid699", tween: [ "style", "${_Content_Feature_Cat1Copy4}", "top", '289px', { fromValue: '289px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid589", tween: [ "style", "${_Desrciption2Copy2}", "top", '499.94px', { fromValue: '499.94px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid590", tween: [ "style", "${_Desrciption2Copy2}", "top", '499.94px', { fromValue: '499.94px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid534", tween: [ "style", "${_Content_Feature_Cat1}", "height", '88.103385925293px', { fromValue: '88.103385925293px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid575", tween: [ "color", "${_Specs_Features_TitleCopy2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid576", tween: [ "color", "${_Specs_Features_TitleCopy2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid733", tween: [ "style", "${_Specs_Features_TitleCopy4}", "top", '247.42px', { fromValue: '247px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid580", tween: [ "style", "${_Content_Feature_Cat1Copy2}", "width", '547.79998779297px', { fromValue: '547.79998779297px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid756", tween: [ "style", "${_Desrciption2Copy5}", "top", '499.94px', { fromValue: '499.94px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid757", tween: [ "style", "${_Desrciption2Copy5}", "top", '499.94px', { fromValue: '499.94px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid742", tween: [ "style", "${_Specs_Features_TitleCopy5}", "top", '324.43px', { fromValue: '324.43px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid743", tween: [ "style", "${_Specs_Features_TitleCopy5}", "top", '324.43px', { fromValue: '324.43px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid545", tween: [ "style", "${_Specs_Features_TitleCopy}", "top", '324.43px', { fromValue: '324.43px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid546", tween: [ "style", "${_Specs_Features_TitleCopy}", "top", '324.43px', { fromValue: '324.43px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid539", tween: [ "style", "${_AutogatedNV_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 3000, duration: 388, easing: "easeOutQuad" },
            { id: "eid540", tween: [ "style", "${_AutogatedNV_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 3626, duration: 374, easing: "easeOutQuad" },
            { id: "eid613", tween: [ "color", "${_Desrciption2Copy3}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid614", tween: [ "color", "${_Desrciption2Copy3}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid597", tween: [ "color", "${_Specs_Features_TitleCopy3}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid598", tween: [ "color", "${_Specs_Features_TitleCopy3}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid362", tween: [ "style", "${_grey_full}", "opacity", '1', { fromValue: '0'}], position: 9390, duration: 478, easing: "easeOutQuad" },
            { id: "eid364", tween: [ "style", "${_grey_full}", "opacity", '0', { fromValue: '1'}], position: 10890, duration: 478, easing: "easeOutQuad" },
            { id: "eid709", tween: [ "style", "${_Content_Feature_Cat1Copy7}", "width", '279.26666259766px', { fromValue: '276px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid595", tween: [ "style", "${_Specs_Features_TitleCopy3}", "top", '324.43px', { fromValue: '324.43px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid596", tween: [ "style", "${_Specs_Features_TitleCopy3}", "top", '324.43px', { fromValue: '324.43px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid738", tween: [ "style", "${_G2_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 12250, duration: 388, easing: "easeOutQuad" },
            { id: "eid739", tween: [ "style", "${_G2_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 12876, duration: 374, easing: "easeOutQuad" },
            { id: "eid754", tween: [ "style", "${_Desrciption2Copy5}", "left", '14px', { fromValue: '14px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid755", tween: [ "style", "${_Desrciption2Copy5}", "left", '14px', { fromValue: '14px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid78", tween: [ "style", "${_Line_Spacer2}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid110", tween: [ "style", "${_Line_Spacer2}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid790", tween: [ "style", "${_Content_Feature_Cat1Copy9}", "height", '101px', { fromValue: '101px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid578", tween: [ "style", "${_Content_Feature_Cat1Copy2}", "height", '88.103385925293px', { fromValue: '88.103385925293px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid746", tween: [ "style", "${_Content_Feature_Cat1Copy8}", "height", '88.099998474121px', { fromValue: '88.103385925293px'}], position: 8000, duration: 0, easing: "easeOutQuad" },
            { id: "eid585", tween: [ "color", "${_Desrciption2Copy2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid586", tween: [ "color", "${_Desrciption2Copy2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid695", tween: [ "style", "${_Line_Spacer2Copy4}", "top", '396.17px', { fromValue: '396.17px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid530", tween: [ "style", "${_Content_Feature_Cat1}", "left", '42px', { fromValue: '42px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid548", tween: [ "style", "${_Content_Feature_Cat1Copy}", "height", '88.103385925293px', { fromValue: '88.103385925293px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid559", tween: [ "style", "${_Desrciption2Copy}", "top", '499.94px', { fromValue: '499.94px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid560", tween: [ "style", "${_Desrciption2Copy}", "top", '499.94px', { fromValue: '499.94px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid57", tween: [ "style", "${_Desrciption2}", "left", '14px', { fromValue: '14px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid113", tween: [ "style", "${_Desrciption2}", "left", '14px', { fromValue: '14px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid740", tween: [ "color", "${_Specs_Features_TitleCopy5}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid741", tween: [ "color", "${_Specs_Features_TitleCopy5}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid72", tween: [ "style", "${_Line_Spacer2}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid111", tween: [ "style", "${_Line_Spacer2}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid708", tween: [ "style", "${_Content_Feature_Cat1Copy7}", "height", '18px', { fromValue: '17px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid543", tween: [ "color", "${_Specs_Features_TitleCopy}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid544", tween: [ "color", "${_Specs_Features_TitleCopy}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid555", tween: [ "color", "${_Desrciption2Copy}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid556", tween: [ "color", "${_Desrciption2Copy}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid593", tween: [ "style", "${_G3_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 7500, duration: 388, easing: "easeOutQuad" },
            { id: "eid594", tween: [ "style", "${_G3_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 8000, duration: 374, easing: "easeOutQuad" },
            { id: "eid63", tween: [ "color", "${_Specs_Features_Title}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid89", tween: [ "color", "${_Specs_Features_Title}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid583", tween: [ "style", "${_Line_Spacer2Copy2}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid584", tween: [ "style", "${_Line_Spacer2Copy2}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid705", tween: [ "style", "${_Content_Feature_Cat1Copy4}", "width", '279.26666259766px', { fromValue: '278.93334960938px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid785", tween: [ "style", "${_Content_Feature_Cat1Copy9}", "top", '349px', { fromValue: '349px'}], position: 15000, duration: 0, easing: "easeOutQuad" },
            { id: "eid547", tween: [ "style", "${_Content_Feature_Cat1Copy}", "top", '354px', { fromValue: '354px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid750", tween: [ "style", "${_Line_Spacer2Copy5}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid751", tween: [ "style", "${_Line_Spacer2Copy5}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid550", tween: [ "style", "${_Content_Feature_Cat1Copy}", "width", '547.79998779297px', { fromValue: '547.79998779297px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid793", tween: [ "style", "${_Specs_Features_TitleCopy6}", "top", '325px', { fromValue: '325px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid773", tween: [ "style", "${_Line_Spacer2Copy6}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid774", tween: [ "style", "${_Line_Spacer2Copy6}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid587", tween: [ "style", "${_Desrciption2Copy2}", "left", '14px', { fromValue: '14px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid588", tween: [ "style", "${_Desrciption2Copy2}", "left", '14px', { fromValue: '14px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid526", tween: [ "style", "${_Gen1_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 750, duration: 388, easing: "easeOutQuad" },
            { id: "eid528", tween: [ "style", "${_Gen1_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 1376, duration: 374, easing: "easeOutQuad" },
            { id: "eid64", tween: [ "style", "${_Specs_Features_Title}", "height", '18px', { fromValue: '18px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid88", tween: [ "style", "${_Specs_Features_Title}", "height", '18px', { fromValue: '18px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid571", tween: [ "style", "${_Specs_Features_TitleCopy2}", "height", '18px', { fromValue: '18px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid572", tween: [ "style", "${_Specs_Features_TitleCopy2}", "height", '18px', { fromValue: '18px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid702", tween: [ "style", "${_Content_Feature_Cat1Copy6}", "height", '18px', { fromValue: '88.099998474121px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid789", tween: [ "style", "${_Content_Feature_Cat1Copy9}", "width", '538px', { fromValue: '538px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid573", tween: [ "style", "${_Specs_Features_TitleCopy2}", "top", '324.43px', { fromValue: '324.43px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid574", tween: [ "style", "${_Specs_Features_TitleCopy2}", "top", '324.43px', { fromValue: '324.43px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid698", tween: [ "style", "${_Content_Feature_Cat1Copy7}", "top", '272px', { fromValue: '272px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid569", tween: [ "style", "${_G3Pinnacle_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 5500, duration: 388, easing: "easeOutQuad" },
            { id: "eid570", tween: [ "style", "${_G3Pinnacle_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 6000, duration: 374, easing: "easeOutQuad" },
            { id: "eid611", tween: [ "style", "${_Desrciption2Copy3}", "left", '14px', { fromValue: '14px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid612", tween: [ "style", "${_Desrciption2Copy3}", "left", '14px', { fromValue: '14px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid536", tween: [ "style", "${_Content_Feature_Cat1}", "width", '547.79998779297px', { fromValue: '547.79998779297px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid689", tween: [ "style", "${_Content_Feature_Cat1Copy7}", "left", '37px', { fromValue: '37px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid566", tween: [ "style", "${_green_full}", "height", '990px', { fromValue: '990px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid61", tween: [ "color", "${_Desrciption2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid112", tween: [ "color", "${_Desrciption2}", "color", 'rgba(255,255,255,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,1.00)'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid557", tween: [ "style", "${_Desrciption2Copy}", "left", '14px', { fromValue: '14px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid558", tween: [ "style", "${_Desrciption2Copy}", "left", '14px', { fromValue: '14px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid605", tween: [ "style", "${_Line_Spacer2Copy3}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid606", tween: [ "style", "${_Line_Spacer2Copy3}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid761", tween: [ "style", "${_DigitalNV_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 14500, duration: 388, easing: "easeOutQuad" },
            { id: "eid762", tween: [ "style", "${_DigitalNV_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 15126, duration: 374, easing: "easeOutQuad" },
            { id: "eid692", tween: [ "style", "${_Content_Feature_Cat1Copy5}", "left", '318px', { fromValue: '318px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid697", tween: [ "style", "${_Description_TitleCopy4}", "top", '407.12px', { fromValue: '407.12px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid58", tween: [ "style", "${_Desrciption2}", "top", '499.94px', { fromValue: '499.94px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid114", tween: [ "style", "${_Desrciption2}", "top", '499.94px', { fromValue: '499.94px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid551", tween: [ "style", "${_Line_Spacer2Copy}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid552", tween: [ "style", "${_Line_Spacer2Copy}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid703", tween: [ "style", "${_Content_Feature_Cat1Copy6}", "width", '279.26666259766px', { fromValue: '287px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid579", tween: [ "style", "${_Content_Feature_Cat1Copy2}", "left", '42px', { fromValue: '42px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid781", tween: [ "style", "${_Desrciption2Copy6}", "width", '598.66485595703px', { fromValue: '598.66485595703px'}], position: 12638, duration: 0, easing: "easeOutQuad" },
            { id: "eid691", tween: [ "style", "${_Content_Feature_Cat1Copy6}", "left", '318px', { fromValue: '318px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid725", tween: [ "style", "${_BWNV_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 9868, duration: 393, easing: "easeOutQuad" },
            { id: "eid735", tween: [ "style", "${_BWNV_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 10516, duration: 374, easing: "easeOutQuad" },
            { id: "eid79", tween: [ "style", "${_Specs_Features_Title}", "top", '324.43px', { fromValue: '324.43px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid90", tween: [ "style", "${_Specs_Features_Title}", "top", '324.43px', { fromValue: '324.43px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid690", tween: [ "style", "${_Content_Feature_Cat1Copy4}", "left", '37.07px', { fromValue: '37.07px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid581", tween: [ "style", "${_Line_Spacer2Copy2}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid582", tween: [ "style", "${_Line_Spacer2Copy2}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid577", tween: [ "style", "${_Content_Feature_Cat1Copy2}", "top", '354px', { fromValue: '354px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid747", tween: [ "style", "${_Content_Feature_Cat1Copy8}", "width", '538.05780029297px', { fromValue: '547.79998779297px'}], position: 8000, duration: 0, easing: "easeOutQuad" },
            { id: "eid707", tween: [ "style", "${_Content_Feature_Cat1Copy5}", "width", '279.26666259766px', { fromValue: '297.76483154297px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid748", tween: [ "style", "${_Line_Spacer2Copy5}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid749", tween: [ "style", "${_Line_Spacer2Copy5}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid704", tween: [ "style", "${_Content_Feature_Cat1Copy4}", "height", '102.84218597412px', { fromValue: '88.099998474121px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid701", tween: [ "style", "${_Content_Feature_Cat1Copy5}", "top", '289px', { fromValue: '289px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid706", tween: [ "style", "${_Content_Feature_Cat1Copy5}", "height", '102.84218597412px', { fromValue: '88.099998474121px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid553", tween: [ "style", "${_Line_Spacer2Copy}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid554", tween: [ "style", "${_Line_Spacer2Copy}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid599", tween: [ "style", "${_Specs_Features_TitleCopy3}", "height", '18px', { fromValue: '18px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid600", tween: [ "style", "${_Specs_Features_TitleCopy3}", "height", '18px', { fromValue: '18px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid522", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 250, duration: 500, easing: "easeOutQuad" },
            { id: "eid524", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 1750, duration: 560, easing: "easeOutQuad" },
            { id: "eid537", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 2500, duration: 500, easing: "easeOutQuad" },
            { id: "eid538", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 4000, duration: 560, easing: "easeOutQuad" },
            { id: "eid567", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 5000, duration: 500, easing: "easeOutQuad" },
            { id: "eid568", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 6374, duration: 560, easing: "easeOutQuad" },
            { id: "eid591", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 7000, duration: 500, easing: "easeOutQuad" },
            { id: "eid592", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 8374, duration: 560, easing: "easeOutQuad" },
            { id: "eid736", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 11750, duration: 500, easing: "easeOutQuad" },
            { id: "eid737", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 13250, duration: 560, easing: "easeOutQuad" },
            { id: "eid532", tween: [ "style", "${_Content_Feature_Cat1}", "top", '354px', { fromValue: '354px'}], position: 1250, duration: 0, easing: "easeOutQuad" },
            { id: "eid452", tween: [ "style", "${symbolSelector}", "opacity", '1', { fromValue: '0'}], position: 14000, duration: 478, easing: "easeOutQuad" },
            { id: "eid453", tween: [ "style", "${symbolSelector}", "opacity", '0', { fromValue: '1'}], position: 15478, duration: 478, easing: "easeOutQuad" },
            { id: "eid456", tween: [ "style", "${symbolSelector}", "opacity", '0', { fromValue: '0'}], position: 15956, duration: 0, easing: "easeOutQuad" },
            { id: "eid771", tween: [ "style", "${_Line_Spacer2Copy6}", "left", '0.02px', { fromValue: '0.02px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid772", tween: [ "style", "${_Line_Spacer2Copy6}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid609", tween: [ "style", "${_Desrciption2Copy3}", "top", '499.94px', { fromValue: '499.94px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid610", tween: [ "style", "${_Desrciption2Copy3}", "top", '499.94px', { fromValue: '499.94px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid700", tween: [ "style", "${_Content_Feature_Cat1Copy6}", "top", '272px', { fromValue: '272px'}], position: 10373, duration: 0, easing: "easeOutQuad" },
            { id: "eid630", tween: [ "style", "${_Line_Spacer2Copy4}", "opacity", '0.35', { fromValue: '0.35'}], position: 3000, duration: 0, easing: "easeOutQuad" },
            { id: "eid631", tween: [ "style", "${_Line_Spacer2Copy4}", "opacity", '0.35', { fromValue: '0.35'}], position: 5250, duration: 0, easing: "easeOutQuad" },
            { id: "eid541", tween: [ "style", "${_Specs_Features_TitleCopy}", "height", '18px', { fromValue: '18px'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid542", tween: [ "style", "${_Specs_Features_TitleCopy}", "height", '18px', { fromValue: '18px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid617", tween: [ "style", "${_Content_Feature_Cat1Copy3}", "width", '538.05780029297px', { fromValue: '547.79998779297px'}], position: 8000, duration: 0, easing: "easeOutQuad" },
            { id: "eid607", tween: [ "style", "${_Line_Spacer2Copy3}", "opacity", '0.35', { fromValue: '0.35'}], position: 627, duration: 0, easing: "easeOutQuad" },
            { id: "eid608", tween: [ "style", "${_Line_Spacer2Copy3}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid730", tween: [ "style", "${_Desrciption2Copy4}", "top", '434px', { fromValue: '434px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid628", tween: [ "style", "${_Line_Spacer2Copy4}", "left", '0.02px', { fromValue: '0.02px'}], position: 3000, duration: 0, easing: "easeOutQuad" },
            { id: "eid629", tween: [ "style", "${_Line_Spacer2Copy4}", "left", '0.02px', { fromValue: '0.02px'}], position: 5250, duration: 0, easing: "easeOutQuad" }         ]
      }
   }
},
"onclick4all2": {
   version: "1.0.0",
   minimumCompatibleVersion: "0.1.7",
   build: "1.0.0.185",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
   dom: [
   {
      id: 'green_full',
      type: 'image',
      rect: ['0px','0px','958px','987px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/green_full.png','0px','0px']
   },
   {
      id: 'blue_full',
      type: 'image',
      rect: ['0px','0px','963px','990px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/blue_full.png','0px','0px']
   },
   {
      id: 'red_full',
      type: 'image',
      rect: ['0px','0px','963px','990px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/red_full.png','0px','0px']
   },
   {
      type: 'group',
      display: 'none',
      id: 'Daytime_Content_Group',
      rect: ['160px','225px','621','696','auto','auto'],
      c: [
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Desrciption2Copy8',
         text: 'Daytime Optics is most popular form of sporting optics. Optics is part of everyday life.  The ubiquity of visual systems in biology indicates the central role optics plays as the science of one of the five senses. Most common fashion is utilizing daytime Rifle Scopes, Binoculars, and Spotting Scopes.  Daytime Optics contains single lenses which has a variety of applications including photographic lenses, corrective lenses, and magnifying glasses.  Empowering your sight with daytime optics provides definitive close up to miles.  Per any application such as hunting, observing, spotting, boating, for security and professional applications, government agencies, science, and medicine.  If you are shooting a deer, observing the stars, magnifying on a blood sample, home security, guarding from the tower, testing the field while golfing, or reading book.  Daytime Optics is essential per everyday usage.<br>',
         align: 'left',
         rect: ['12px','508px','591px','197px','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         type: 'text',
         id: 'Description_TitleCopy8',
         text: 'Description',
         align: 'left',
         rect: ['14px','474px','auto','auto','auto','auto']
      },
      {
         type: 'rect',
         id: 'Line_Spacer2Copy8',
         stroke: [1,'rgb(0, 0, 0)','none'],
         rect: ['0px','456px','621px','1px','auto','auto'],
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Content_Feature_Cat1Copy11',
         text: '- None',
         align: 'left',
         rect: ['61px','370px','229px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         type: 'text',
         id: 'Specs_Features_TitleCopy8',
         text: 'Specs and Features',
         align: 'center',
         rect: ['196px','324px','229px','50px','auto','auto']
      },
      {
         rect: ['68px','313px','484px','1px','auto','auto'],
         opacity: 0.35,
         id: 'Line_Spacer1Copy8',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         type: 'rect',
         id: 'Image_PlaceholderCopy8',
         stroke: [0,'rgb(0, 0, 0)','none'],
         rect: ['150px','118px','320px','180px','auto','auto'],
         fill: ['rgba(192,192,192,1)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Text14Copy8',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         rect: ['184px','237px','250px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         type: 'text',
         id: 'Text13Copy8',
         text: 'Video/Image Placeholder',
         align: 'center',
         rect: ['150px','193px','320px','44px','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         type: 'text',
         id: 'TitleCopy8',
         text: 'Daytime Optics',
         align: 'center',
         rect: ['173px','73px','279px','42px','auto','auto']
      }]
   },
   {
      type: 'group',
      display: 'none',
      id: 'DigitalNV_Content_GroupCopy',
      rect: ['174','298','621','628','auto','auto'],
      c: [
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Desrciption2',
         text: 'As opposed to analog Night Vision devices, the Digital Night Vision  offers unique advantages.  First you don’t have to worry about lens cap staying on during the day, its digital! Second, you can record and extract images and videos.  Third it doesn’t have tube life hours, so it could last as long as possible.  Digital Night Vision offers fine image quality and resolution.  With windage and elevation by pixels, very precise shooting experience.  Higher performance than a 2nd generation night vision unit, digital night vision provides ultimate performance for all technological advancement &amp; value seeker.<br>',
         align: 'left',
         rect: ['14px','432px','591px','197px','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         type: 'text',
         id: 'Description_Title',
         text: 'Description',
         align: 'left',
         rect: ['14px','401px','auto','auto','auto','auto']
      },
      {
         type: 'rect',
         id: 'Line_Spacer2',
         stroke: [1,'rgb(0, 0, 0)','none'],
         rect: ['0px','383px','621px','1px','auto','auto'],
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Content_Feature_Cat1Copy3',
         text: '- Can operate day/night<br>- Highly Sensitive CCD Array<br>- External Power Supply<br>- Increase in performance: Increase 150% in performance from Generation 1<br>- Resolution, Pixels: 640x480<br>- Distance: 200+ Yards<br>- White Phosphor Technology<br>',
         align: 'left',
         rect: ['58px','296px','229px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         type: 'text',
         id: 'Specs_Features_Title',
         text: 'Specs and Features',
         align: 'center',
         rect: ['196px','252px','229px','50px','auto','auto']
      },
      {
         rect: ['68px','240px','484px','1px','auto','auto'],
         opacity: 0.35,
         id: 'Line_Spacer1',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         type: 'rect',
         id: 'Image_Placeholder',
         stroke: [0,'rgb(0, 0, 0)','none'],
         rect: ['150px','45px','320px','180px','auto','auto'],
         fill: ['rgba(192,192,192,1)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Text14',
         text: 'Based on actual dimensions of 16:9 video. 320px x 180px.',
         align: 'center',
         rect: ['184px','164px','250px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',21,'rgba(0,0,0,1)','700','none','normal'],
         type: 'text',
         id: 'Text13',
         text: 'Video/Image Placeholder',
         align: 'center',
         rect: ['150px','120px','320px','44px','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         type: 'text',
         id: 'Title',
         text: 'Digital NV',
         align: 'center',
         rect: ['173px','0px','279px','42px','auto','auto']
      }]
   },
   {
      type: 'group',
      display: 'none',
      id: 'Thermal_Content_Group',
      rect: ['174','298','621','628','auto','auto'],
      c: [
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Desrciption2Copy9',
         text: 'Thermal Imaging systems are frequently used in perimeter security and surveillance applications and allow the user to see though most weather conditions day or night.  In every day life, thermal imaging is utilized in night vision applications and Is used extensively by the United States armed forces.<br> Thermal imagining detects suspicious activity over long distances in total darkness and though fog, smoke, dust, foliage, and many other obscurants.  This allows officers to approach in stealth mode and makes better-informed decisions more quickly.  Cameras maybe handheld, vehicle-mounted, tripod-mounted, or weapon-mounted.  Thermal imagining revels “hot spot” where failure maybe imminent in many electrical and industrial facilities and installations.   Thermal is utilized for hunting applications, as is best method to scout highlighted target and be able to see anything, which contains heat signature and is easy to detect any objective.  Thermal Imagining is great for any recreational application even for mechanist, farmers, researchers, and just about anything else.  For professional applications Thermal Imagining is utilized for fugitive searches, officer safety, surveillance activities, hidden compartments, accident investigation, search and rescue, disturbed surfaces, marine patrol, locating evidence, and tactical teams.<br>',
         align: 'left',
         rect: ['14px','432px','591px','197px','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(255,255,255,1.00)','bold','none','normal'],
         type: 'text',
         id: 'Description_TitleCopy9',
         text: 'Description',
         align: 'left',
         rect: ['14px','401px','auto','auto','auto','auto']
      },
      {
         type: 'rect',
         id: 'Line_Spacer2Copy9',
         stroke: [1,'rgb(0, 0, 0)','none'],
         rect: ['0px','383px','621px','1px','auto','auto'],
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Content_Feature_Cat1Copy12',
         text: '- 7.5Hz- slowest refreshment rate<br>- 9Hz- slow refreshment rate<br>- 30Hz-Standard “As Is” refreshment rate<br>- 60Hz- Fast refreshment rate<br>',
         align: 'left',
         rect: ['58px','296px','229px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','400','none','normal'],
         type: 'text',
         id: 'Content_Feature_Cat1Copy13',
         text: '- 160x120-Lowest Resolution/450 Yards<br>- 320x240-Standard Resolution/ 750 Yards <br>- 640x480-Highest Resolution/ 1,500 Yards<br>',
         align: 'left',
         rect: ['58px','296px','229px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',12,'rgba(0,0,0,1)','700','none','normal'],
         type: 'text',
         id: 'Content_Feature_Cat1Copy14',
         text: 'Sensor (Microbolometer) / Detection Range',
         align: 'left',
         rect: ['58px','296px','229px','auto','auto','auto']
      },
      {
         font: ['Arial, Helvetica, sans-serif',16,'rgba(0,0,0,1)','bold','none','normal'],
         type: 'text',
         id: 'Specs_Features_TitleCopy9',
         text: 'Specs and Features',
         align: 'center',
         rect: ['196px','252px','229px','50px','auto','auto']
      },
      {
         rect: ['68px','240px','484px','1px','auto','auto'],
         opacity: 0.35,
         id: 'Line_Spacer1Copy9',
         stroke: [1,'rgb(0, 0, 0)','none'],
         type: 'rect',
         fill: ['rgba(255,255,255,1.00)']
      },
      {
         font: ['Arial, Helvetica, sans-serif',28,'rgba(255,255,255,1)','700','none','normal'],
         type: 'text',
         id: 'TitleCopy9',
         text: 'Thermal',
         align: 'center',
         rect: ['173px','0px','279px','42px','auto','auto']
      }]
   }],
   symbolInstances: [
   ]
   },
   states: {
      "Base State": {
         "${_Desrciption2Copy9}": [
            ["style", "top", '432px'],
            ["style", "font-size", '12px'],
            ["style", "height", '196.5px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "width", '598.66485595703px']
         ],
         "${_Desrciption2}": [
            ["style", "top", '432px'],
            ["style", "width", '598.66485595703px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '196.5px'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "font-size", '12px']
         ],
         "${_Content_Feature_Cat1Copy14}": [
            ["style", "top", '296px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '17px'],
            ["style", "font-weight", '700'],
            ["style", "left", '313px'],
            ["style", "width", '255px']
         ],
         "${_Desrciption2Copy8}": [
            ["style", "top", '505px'],
            ["style", "width", '598.66485595703px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '196.5px'],
            ["style", "font-weight", '400'],
            ["style", "left", '14px'],
            ["style", "font-size", '12px']
         ],
         "${_Text14Copy8}": [
            ["style", "top", '236.62px'],
            ["style", "font-size", '12px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "width", '250px']
         ],
         "${_Line_Spacer2Copy8}": [
            ["style", "top", '456.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '0.02px'],
            ["style", "border-style", 'none'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Description_Title}": [
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '401.12px'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Text14}": [
            ["style", "top", '163.62px'],
            ["style", "font-size", '12px'],
            ["style", "font-weight", '400'],
            ["style", "left", '183.8px'],
            ["style", "width", '250px']
         ],
         "${_TitleCopy9}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '0.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "height", '42px'],
            ["style", "text-decoration", 'none'],
            ["style", "width", '279.27380371094px']
         ],
         "${_red_full}": [
            ["style", "top", '0px'],
            ["style", "height", '990px'],
            ["style", "opacity", '0'],
            ["style", "left", '0px'],
            ["style", "width", '963px']
         ],
         "${_Content_Feature_Cat1Copy12}": [
            ["style", "top", '299px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '69.796875px'],
            ["style", "font-weight", '400'],
            ["style", "left", '58px'],
            ["style", "width", '255px']
         ],
         "${_Line_Spacer2}": [
            ["style", "top", '383.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '0.02px'],
            ["style", "border-style", 'none'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Specs_Features_Title}": [
            ["style", "top", '252px'],
            ["style", "text-align", 'center'],
            ["style", "width", '228.5333404541px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "font-size", '16px']
         ],
         "${_Image_Placeholder}": [
            ["style", "top", '45.02px'],
            ["style", "height", '180px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_TitleCopy8}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '73.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "width", '279.27380371094px'],
            ["style", "text-decoration", 'none'],
            ["style", "height", '42px']
         ],
         "${_Specs_Features_TitleCopy9}": [
            ["style", "top", '252px'],
            ["style", "text-align", 'center'],
            ["style", "font-size", '16px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "width", '228.5333404541px']
         ],
         "${symbolSelector}": [
            ["style", "height", '990px'],
            ["style", "width", '963px']
         ],
         "${_DigitalNV_Content_GroupCopy}": [
            ["style", "display", 'none'],
            ["style", "opacity", '0'],
            ["style", "left", '177px']
         ],
         "${_Daytime_Content_Group}": [
            ["style", "display", 'none'],
            ["style", "opacity", '0.000000'],
            ["style", "left", '174px']
         ],
         "${_blue_full}": [
            ["style", "top", '0px'],
            ["style", "height", '990px'],
            ["style", "opacity", '0'],
            ["style", "left", '0px'],
            ["style", "width", '963px']
         ],
         "${_Description_TitleCopy8}": [
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '474.12px'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Specs_Features_TitleCopy8}": [
            ["style", "top", '325px'],
            ["style", "text-align", 'center'],
            ["style", "width", '228.5333404541px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '18px'],
            ["style", "left", '195.8px'],
            ["style", "font-size", '16px']
         ],
         "${_Content_Feature_Cat1Copy11}": [
            ["style", "top", '348px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '101px'],
            ["style", "font-weight", '400'],
            ["style", "left", '58px'],
            ["style", "width", '494px']
         ],
         "${_Content_Feature_Cat1Copy3}": [
            ["style", "top", '276px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '99px'],
            ["style", "font-weight", '400'],
            ["style", "left", '58px'],
            ["style", "width", '526px']
         ],
         "${_Thermal_Content_Group}": [
            ["style", "display", 'none'],
            ["style", "opacity", '0']
         ],
         "${_Image_PlaceholderCopy8}": [
            ["style", "top", '118.02px'],
            ["style", "height", '180px'],
            ["style", "left", '149.8px'],
            ["style", "width", '320px']
         ],
         "${_Content_Feature_Cat1Copy13}": [
            ["style", "top", '299px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "height", '69.796875px'],
            ["style", "font-weight", '400'],
            ["style", "left", '313px'],
            ["style", "width", '255px']
         ],
         "${_Line_Spacer1Copy8}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '67.8px'],
            ["style", "top", '313.17px']
         ],
         "${_Text13Copy8}": [
            ["style", "top", '192.62px'],
            ["style", "text-align", 'center'],
            ["style", "width", '320px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "font-size", '21px']
         ],
         "${_Line_Spacer1}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-style", 'none'],
            ["style", "border-width", '1px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "left", '67.8px'],
            ["style", "top", '240.17px']
         ],
         "${_Line_Spacer2Copy9}": [
            ["style", "top", '391.17px'],
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "border-width", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "height", '1px'],
            ["style", "border-style", 'none'],
            ["style", "left", '0.02px'],
            ["style", "width", '621.40728759766px']
         ],
         "${_Title}": [
            ["style", "font-weight", '700'],
            ["style", "left", '172.97px'],
            ["style", "font-size", '28px'],
            ["style", "top", '0.02px'],
            ["style", "text-align", 'center'],
            ["style", "font-style", 'normal'],
            ["style", "width", '279.27380371094px'],
            ["style", "text-decoration", 'none'],
            ["style", "height", '42px']
         ],
         "${_green_full}": [
            ["style", "top", '0px'],
            ["style", "opacity", '0'],
            ["style", "left", '3px']
         ],
         "${_Text13}": [
            ["style", "top", '119.62px'],
            ["style", "text-align", 'center'],
            ["style", "width", '320px'],
            ["style", "height", '44px'],
            ["style", "font-weight", '700'],
            ["style", "left", '149.8px'],
            ["style", "font-size", '21px']
         ],
         "${_Description_TitleCopy9}": [
            ["style", "top", '401.12px'],
            ["color", "color", 'rgba(255,255,255,1.00)'],
            ["style", "left", '14.22px'],
            ["style", "font-size", '16px']
         ],
         "${_Line_Spacer1Copy9}": [
            ["color", "background-color", 'rgba(255,255,255,1.00)'],
            ["style", "top", '240.17px'],
            ["style", "left", '67.8px'],
            ["style", "height", '1px'],
            ["style", "opacity", '0.35'],
            ["style", "border-width", '1px'],
            ["style", "border-style", 'none']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 17012,
         autoPlay: false,
         labels: {
            "daytime_in": 1000,
            "daytime_out": 2126,
            "thermal_in": 3500,
            "thermal_out": 4626,
            "digitalnv_in": 6000,
            "digitalnv_out": 7126
         },
         timeline: [
            { id: "eid890", tween: [ "style", "${_Content_Feature_Cat1Copy12}", "top", '299px', { fromValue: '299px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid850", tween: [ "style", "${_Desrciption2Copy9}", "width", '598.66485595703px', { fromValue: '598.66485595703px'}], position: 12638, duration: 0, easing: "easeOutQuad" },
            { id: "eid1013", tween: [ "style", "${_Content_Feature_Cat1Copy3}", "top", '276px', { fromValue: '276px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid838", tween: [ "style", "${_red_full}", "opacity", '1', { fromValue: '0'}], position: 3500, duration: 500, easing: "easeOutQuad" },
            { id: "eid895", tween: [ "style", "${_red_full}", "opacity", '0', { fromValue: '1'}], position: 5000, duration: 500, easing: "easeOutQuad" },
            { id: "eid818", tween: [ "style", "${_Desrciption2Copy8}", "width", '598.66485595703px', { fromValue: '598.66485595703px'}], position: 12638, duration: 0, easing: "easeOutQuad" },
            { id: "eid1234", tween: [ "style", "${_Thermal_Content_Group}", "display", 'block', { fromValue: 'none'}], position: 4000, duration: 0, easing: "easeOutQuad" },
            { id: "eid1235", tween: [ "style", "${_Thermal_Content_Group}", "display", 'none', { fromValue: 'block'}], position: 5000, duration: 0, easing: "easeOutQuad" },
            { id: "eid990", tween: [ "style", "${_Desrciption2}", "width", '598.66485595703px', { fromValue: '598.66485595703px'}], position: 17012, duration: 0, easing: "easeOutQuad" },
            { id: "eid878", tween: [ "style", "${_Thermal_Content_Group}", "opacity", '1', { fromValue: '0'}], position: 4000, duration: 374, easing: "easeOutQuad" },
            { id: "eid882", tween: [ "style", "${_Thermal_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 4626, duration: 374, easing: "easeOutQuad" },
            { id: "eid1236", tween: [ "style", "${_DigitalNV_Content_GroupCopy}", "display", 'block', { fromValue: 'none'}], position: 6500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1237", tween: [ "style", "${_DigitalNV_Content_GroupCopy}", "display", 'none', { fromValue: 'block'}], position: 7500, duration: 0, easing: "easeOutQuad" },
            { id: "eid816", tween: [ "style", "${_Line_Spacer2Copy8}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid873", tween: [ "style", "${_Desrciption2Copy9}", "top", '432px', { fromValue: '432px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid875", tween: [ "style", "${_Specs_Features_TitleCopy9}", "top", '252px', { fromValue: '252px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid972", tween: [ "style", "${_DigitalNV_Content_GroupCopy}", "opacity", '1', { fromValue: '0'}], position: 6500, duration: 374, easing: "easeOutQuad" },
            { id: "eid973", tween: [ "style", "${_DigitalNV_Content_GroupCopy}", "opacity", '0', { fromValue: '1'}], position: 7126, duration: 374, easing: "easeOutQuad" },
            { id: "eid847", tween: [ "style", "${_Line_Spacer2Copy9}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid1015", tween: [ "style", "${_Line_Spacer2Copy9}", "top", '391.17px', { fromValue: '391.17px'}], position: 7065, duration: 0, easing: "easeOutQuad" },
            { id: "eid889", tween: [ "style", "${_Content_Feature_Cat1Copy13}", "top", '299px', { fromValue: '299px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid865", tween: [ "style", "${_Content_Feature_Cat1Copy14}", "top", '282px', { fromValue: '296px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid828", tween: [ "style", "${_Content_Feature_Cat1Copy11}", "top", '348px', { fromValue: '348px'}], position: 2126, duration: 0, easing: "easeOutQuad" },
            { id: "eid1042", tween: [ "style", "${_DigitalNV_Content_GroupCopy}", "left", '177px', { fromValue: '177px'}], position: 6874, duration: 0, easing: "easeOutQuad" },
            { id: "eid989", tween: [ "style", "${_Desrciption2}", "top", '432px', { fromValue: '432px'}], position: 4374, duration: 0, easing: "easeOutQuad" },
            { id: "eid1043", tween: [ "style", "${_green_full}", "left", '3px', { fromValue: '3px'}], position: 6874, duration: 0, easing: "easeOutQuad" },
            { id: "eid848", tween: [ "style", "${_Line_Spacer2Copy9}", "opacity", '0.35', { fromValue: '0.35'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid817", tween: [ "style", "${_Desrciption2Copy8}", "top", '505px', { fromValue: '505px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid974", tween: [ "style", "${_Specs_Features_Title}", "top", '252px', { fromValue: '252px'}], position: 4374, duration: 0, easing: "easeOutQuad" },
            { id: "eid860", tween: [ "style", "${_Content_Feature_Cat1Copy13}", "width", '255px', { fromValue: '255px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid831", tween: [ "style", "${_Content_Feature_Cat1Copy11}", "width", '494px', { fromValue: '494px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid832", tween: [ "style", "${_Content_Feature_Cat1Copy11}", "width", '494px', { fromValue: '494px'}], position: 2126, duration: 0, easing: "easeOutQuad" },
            { id: "eid1232", tween: [ "style", "${_Daytime_Content_Group}", "display", 'none', { fromValue: 'none'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid1231", tween: [ "style", "${_Daytime_Content_Group}", "display", 'block', { fromValue: 'none'}], position: 1500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1233", tween: [ "style", "${_Daytime_Content_Group}", "display", 'none', { fromValue: 'block'}], position: 2500, duration: 0, easing: "easeOutQuad" },
            { id: "eid1011", tween: [ "style", "${_Content_Feature_Cat1Copy3}", "width", '525.7507400552731px', { fromValue: '526px'}], position: 6500, duration: 0, easing: "easeOutQuad" },
            { id: "eid809", tween: [ "style", "${_Specs_Features_TitleCopy8}", "top", '325px', { fromValue: '325px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid971", tween: [ "style", "${_green_full}", "opacity", '1', { fromValue: '0'}], position: 6000, duration: 500, easing: "easeOutQuad" },
            { id: "eid1001", tween: [ "style", "${_green_full}", "opacity", '0', { fromValue: '1'}], position: 7500, duration: 500, easing: "easeOutQuad" },
            { id: "eid821", tween: [ "style", "${_blue_full}", "opacity", '1', { fromValue: '0'}], position: 1000, duration: 500, easing: "easeOutQuad" },
            { id: "eid826", tween: [ "style", "${_blue_full}", "opacity", '0', { fromValue: '1'}], position: 2500, duration: 500, easing: "easeOutQuad" },
            { id: "eid807", tween: [ "style", "${_Daytime_Content_Group}", "opacity", '1', { fromValue: '0.000000'}], position: 1500, duration: 388, easing: "easeOutQuad" },
            { id: "eid808", tween: [ "style", "${_Daytime_Content_Group}", "opacity", '0', { fromValue: '1'}], position: 2126, duration: 374, easing: "easeOutQuad" },
            { id: "eid822", tween: [ "style", "${_Daytime_Content_Group}", "left", '174px', { fromValue: '174px'}], position: 1888, duration: 0, easing: "easeOutQuad" },
            { id: "eid857", tween: [ "style", "${_Content_Feature_Cat1Copy12}", "width", '255px', { fromValue: '255px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid861", tween: [ "style", "${_Content_Feature_Cat1Copy13}", "left", '313px', { fromValue: '313px'}], position: 4626, duration: 0, easing: "easeOutQuad" },
            { id: "eid863", tween: [ "style", "${_Content_Feature_Cat1Copy14}", "left", '313px', { fromValue: '313px'}], position: 718, duration: 0, easing: "easeOutQuad" },
            { id: "eid987", tween: [ "style", "${_Line_Spacer2}", "left", '0.02px', { fromValue: '0.02px'}], position: 7251, duration: 0, easing: "easeOutQuad" },
            { id: "eid866", tween: [ "style", "${_Content_Feature_Cat1Copy14}", "height", '17px', { fromValue: '17px'}], position: 0, duration: 0, easing: "easeOutQuad" },
            { id: "eid827", tween: [ "style", "${_Content_Feature_Cat1Copy11}", "left", '58px', { fromValue: '58px'}], position: 2126, duration: 0, easing: "easeOutQuad" },
            { id: "eid814", tween: [ "style", "${_Line_Spacer2Copy8}", "left", '0.02px', { fromValue: '0.02px'}], position: 2877, duration: 0, easing: "easeOutQuad" },
            { id: "eid988", tween: [ "style", "${_Line_Spacer2}", "opacity", '0.35', { fromValue: '0.35'}], position: 7251, duration: 0, easing: "easeOutQuad" }         ]
      }
   }
},
"allvideo": {
   version: "1.0.0",
   minimumCompatibleVersion: "0.1.7",
   build: "1.0.0.185",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
   dom: [
   {
      rect: ['209px','192px','311px','167px','auto','auto'],
      type: 'rect',
      id: 'thermalvideo',
      stroke: [0,'rgb(0, 0, 0)','none'],
      display: 'none',
      fill: ['rgba(192,192,192,1)']
   }],
   symbolInstances: [
   ]
   },
   states: {
      "Base State": {
         "${_thermalvideo}": [
            ["style", "top", '191.8px'],
            ["style", "display", 'none'],
            ["style", "height", '180px'],
            ["style", "opacity", '0'],
            ["style", "left", '208.7px'],
            ["style", "width", '320px']
         ],
         "${symbolSelector}": [
            ["style", "height", '105.89915430744px'],
            ["style", "width", '71px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 2250,
         autoPlay: false,
         labels: {
            "thermal": 500,
            "thermal_out": 1750
         },
         timeline: [
            { id: "eid1253", tween: [ "style", "${_thermalvideo}", "opacity", '1', { fromValue: '0'}], position: 1000, duration: 500, easing: "easeOutQuad" },
            { id: "eid1262", tween: [ "style", "${_thermalvideo}", "opacity", '1', { fromValue: '1'}], position: 1750, duration: 0, easing: "easeOutQuad" },
            { id: "eid1274", tween: [ "style", "${_thermalvideo}", "opacity", '0', { fromValue: '1'}], position: 1905, duration: 345, easing: "easeOutQuad" },
            { id: "eid1268", tween: [ "style", "${_thermalvideo}", "width", '320px', { fromValue: '320px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1269", tween: [ "style", "${_thermalvideo}", "height", '180px', { fromValue: '180px'}], position: 1694, duration: 0, easing: "easeOutQuad" },
            { id: "eid1275", tween: [ "style", "${_thermalvideo}", "display", 'block', { fromValue: 'none'}], position: 1000, duration: 0, easing: "easeOutQuad" },
            { id: "eid1276", tween: [ "style", "${_thermalvideo}", "display", 'none', { fromValue: 'block'}], position: 2250, duration: 0, easing: "easeOutQuad" }         ]
      }
   }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-741842822");
