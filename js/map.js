function initialize() {
  var latlng = new google.maps.LatLng(35.690427,139.707910);
  var myOptions = {
    zoom: 18, /*拡大比率*/
    center: latlng, /*表示枠内の中心点*/
    mapTypeId: google.maps.MapTypeId.ROADMAP/*表示タイプの指定*/
  };
  var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);

  /*アイコン設定▼*/
  var icon = new google.maps.MarkerImage('https://aliving.netimage/schedule_aiso.png',
    new google.maps.Size(100,100),/*アイコンサイズ設定*/
    new google.maps.Point(0,0)/*アイコン位置設定*/
    );
  var markerOptions = {
    position: latlng,
    map: map,
    icon: icon,
    title: 'AiSOTOPE LOUNGE'
  };
  var marker = new google.maps.Marker(markerOptions);
　/*アイコン設定ここまで▲*/

		
	
	
	
 /*取得スタイルの貼り付け*/
  var styleOptions = [

  {
    "featureType": "landscape.natural",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "road.highway",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "transit.line",
    "stylers": [
      { "visibility": "simplified" }
    ]
  },{
    "elementType": "labels.text",
    "stylers": [
      { "visibility": "simplified" }
    ]
  },{
    "stylers": [
      { "saturation": -50 },
      { "weight": 0.4 }
    ]
  },{
  }
];
  var styledMapOptions = { name: 'AiSOTOPE LOUNGE' }
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('AiSOTOPE LOUNGE', sampleType);
  map.setMapTypeId('AiSOTOPE LOUNGE');
}
