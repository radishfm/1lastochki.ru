/* global ymaps*/

function YandexBranches(arParams) {
	'use strict';

	let _this = this;

	this.arParams = {
		'mainBlock': document.querySelector(arParams.mainBlock),
		'iblock': arParams.iblock,
		'mapID': arParams.mapID,
		'YandexDefaultOption': arParams.YandexDefaultOption,
		'color': arParams.color,
		'branchesList': arParams.branchesList,
		'messages': arParams.messages,
	};

	this.getBranches = function (cityID) {
		let elements = this.arParams.mainBlock.querySelectorAll('.branches__elements');
		for (let i = 0; i < elements.length; ++i) {
			elements[i].innerHTML = "";
		}
		_this.arParams.Collection.removeAll();

		let branches = this.arParams.branchesList[cityID];
		let branchesList = '';

		branchesList += '<div class="branches__elementsInner">';

		for (let i = 0; i < branches.length; i++) {
			let sch = i + 1;

			let placemark = new ymaps.Placemark([branches[i].LON, branches[i].LAT], {
				iconContent: sch,
				idBalloon: branches[i].ID,
				balloonContentHeader: '<div class="branches__balloonHeader" style="color:' + _this.arParams.color + ';" >' + branches[i].NAME + '</div>',
				balloonContentBody: '<div class="branches__balloonBody"><span style="color:' + _this.arParams.color + ';">' + _this.arParams.messages.address + '</span> <span>' + branches[i].ADDRESS + '</span><br>' + '<span style="color:' + _this.arParams.color + ';">' + _this.arParams.messages.phone + '</span> <span>' + branches[i].PHONE + '</span></div>'
			}, {
				preset: 'twirl#nightStretchyIcon',
			});

			_this.arParams.Collection.add(placemark);

			branchesList += '<div class="branches__element" data-branchkey="'+i+'" data-cityid="'+cityID+'">';
			branchesList += sch + '. ';
			branchesList +=  '<span class="branches__elementText">';
			branchesList +=  branches[i].NAME;
			branchesList +=  '</span>';
			branchesList+='</div>';
		}
		branchesList+='</div>';

		_this.arParams.map.geoObjects.add(_this.arParams.Collection);
		_this.arParams.map.setBounds(_this.arParams.Collection.getBounds(), {
			checkZoomRange: true,
		});

		this.arParams.mainBlock.querySelector('.branches__elements[data-cityid="' + cityID + '"]').innerHTML = branchesList;

		let elementList = this.arParams.mainBlock.querySelectorAll('.branches__element');

		Array.prototype.slice.call(elementList).forEach(function(element) {
			element.addEventListener('click', function() {
				_this.viewPlace(this);
				_this.toggleActionList(this, elementList);
			});
		});
	};

	this.viewPlace = function (element) {
		let place = this.arParams.branchesList[element.dataset.cityid][element.dataset.branchkey];
		console.dir(place);

		_this.arParams.map.setCenter([place.LON, place.LAT], 16);

		_this.arParams.Collection.each(function (item) {
			if (+item.properties.get('idBalloon') === +place.ID) {
				item.balloon.open();
			}
		});
	};

	this.toggleAction = function (element) {
		if(element.classList.contains('active')){
			element.classList.remove('active');
		} else {
			element.classList.add('active');
		}
	};

	this.toggleActionList= function (current, list) {
		Array.prototype.slice.call(list).forEach(function(element) {
			element.classList.remove('active');
		});
		current.classList.add('active');
	};

	ymaps.ready(function () {
		_this.arParams.map = new ymaps.Map(_this.arParams.mapID, _this.arParams.YandexDefaultOption);

		_this.arParams.map.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools');

		_this.arParams.Collection = new ymaps.GeoObjectCollection();

		let cities = _this.arParams.mainBlock.querySelectorAll('.branches__city');

		Array.prototype.slice.call(cities).forEach(function(element) {
			//cities.forEach(function(element) {
			element.addEventListener('click', function() {
				_this.getBranches(element.dataset.id);
				_this.toggleActionList(element, cities);
			});
		});

		let activeCity = _this.arParams.mainBlock.querySelector('.branches__city.active');
		_this.getBranches(activeCity.dataset.id);
		_this.toggleActionList(activeCity, cities);
	});
}