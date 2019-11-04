/* global ymaps*/

function YandexGeoItems(arParams) {
	'use strict';

	let _this = this;

	this.arParams = {
		'mainBlockSelector': document.querySelector(arParams.mainBlockSelector),
		'sectionSelector': arParams.sectionSelector,
		'elementsSelector': arParams.elementsSelector,
		'elementSelector': arParams.elementsSelector,
		'activeClass': arParams.activeClass,
		'iblock': arParams.iblock,
		'mapID': arParams.mapID,
		'YandexDefaultOption': arParams.YandexDefaultOption,
		'color': arParams.color,
		'geoItemsElements': arParams.geoItemsElements,
	};

	this.getBranches = function (sectionID) {
		let elementsNodeList = this.arParams.mainBlockSelector.querySelectorAll(_this.arParams.elementsSelector);
		for (let i = 0; i < elementsNodeList.length; ++i) {
			elementsNodeList[i].innerHTML = '';
		}
		_this.arParams.Collection.removeAll();

		let currentElements = this.arParams.geoItemsElements[sectionID];
		let geoItemsElements = '';



		geoItemsElements += '<div class="geoItems__elementsInner">';
		_this.arParams.messages = {};
		_this.arParams.messages.address = _this.arParams.messages.phone = "";

		for (let i = 0; i < currentElements.length; i++) {
			if(
				typeof currentElements[i].LON != 'undefined' && currentElements[i].LON !== ''
				&& typeof currentElements[i].LAT != 'undefined' && currentElements[i].LAT !== ''
			) {
				let balloonBody = '', balloonContentHeader = '';
				if (typeof currentElements[i].NAME != 'undefined' && currentElements[i].NAME !== '') {
					balloonContentHeader += '<div class="geoItems__balloonHeader">' + currentElements[i].NAME + '</div>';
				}
				if (typeof currentElements[i].PREVIEW_TEXT != 'undefined' && currentElements[i].PREVIEW_TEXT !== '') {
					balloonBody += '<div class="geoItems__previewText">' + currentElements[i].PREVIEW_TEXT + '</div>';
				}
				if (typeof currentElements[i].DETAIL_PAGE_URL != 'undefined' && currentElements[i].DETAIL_PAGE_URL !== '') {
					balloonBody += '<a class="geoItems__detailPageUrl" href="' + currentElements[i].DETAIL_PAGE_URL + '">Подробнее</a>';
				}

				let sch = i + 1;
				let placeMark = new ymaps.Placemark([currentElements[i].LON, currentElements[i].LAT], {
					iconContent: sch,
					idBalloon: currentElements[i].ID,
					balloonContentHeader: balloonContentHeader,
					balloonContentBody: balloonBody
				}, {
					preset: 'twirl#nightStretchyIcon',
				});

				const myPlacemark = new ymaps.Placemark([currentElements[i].LON, currentElements[i].LAT], {
					iconContent: sch,
					idBalloon: currentElements[i].ID,
					balloonContentHeader: balloonContentHeader,
					balloonContentBody: balloonBody
				}, {
					// Опции.
					// Необходимо указать данный тип макета.
					iconLayout: 'default#image',
					// Своё изображение иконки метки.
					iconImageHref: '/upload/medialibrary/c40/obelisk.png',
					// Размеры метки.
					iconImageSize: [60, 60],
					// Смещение левого верхнего угла иконки относительно
					// её "ножки" (точки привязки).
					iconImageOffset: [-30, -60]
				});

				_this.arParams.Collection.add(myPlacemark);

				geoItemsElements += '<div class="geoItems__element" data-branchkey="'+i+'" data-sectionID="'+sectionID+'">';
				geoItemsElements += sch + '. ';
				geoItemsElements +=  '<span class="geoItems__elementText">';
				geoItemsElements +=  currentElements[i].NAME;
				geoItemsElements +=  '</span>';
				geoItemsElements+='</div>';
			}
		}
		geoItemsElements+='</div>';
		console.dir(_this.arParams.Collection.getBounds());

		_this.arParams.map.geoObjects.add(_this.arParams.Collection);
		_this.arParams.map.setBounds(_this.arParams.Collection.getBounds(), {
			checkZoomRange: true,
		});

		this.arParams.mainBlockSelector.querySelector(_this.arParams.elementsSelector + '[data-sectionID="' + sectionID + '"]').innerHTML = geoItemsElements;

		let elementList = this.arParams.mainBlockSelector.querySelectorAll('.geoItems__element');
		/*

		Array.prototype.slice.call(elementList).forEach(function(element) {
			element.addEventListener('click', function(event) {
				_this.viewPlace(element);
				_this.toggleActionList(this, elementList);
			});
		});*/

		$('.geoItems__element').each(function (i,item) {
			$(item).on('click', function () {
				_this.viewPlace(this);
				_this.toggleActionList(this, elementList);
			})
		});

	};

	this.viewPlace = function (element) {
		let data = $(element).data();
		let place = this.arParams.geoItemsElements[data.sectionid][data.branchkey];
		console.dir(place);

		_this.arParams.map.setCenter([place.LON, place.LAT], 16);

		_this.arParams.Collection.each(function (item) {
			if (+item.properties.get('idBalloon') === +place.ID) {
				item.balloon.open();
			}
		});
	};

	this.toggleAction = function (element) {
		if(element.classList.contains(_this.arParams.activeClass)){
			element.classList.remove(_this.arParams.activeClass);
		} else {
			element.classList.add(_this.arParams.activeClass);
		}
	};

	this.toggleActionList= function (current, list) {
		Array.prototype.slice.call(list).forEach(function(element) {
			element.classList.remove(_this.arParams.activeClass);
		});
		current.classList.add(_this.arParams.activeClass);
	};

	ymaps.ready(function () {
		_this.arParams.map = new ymaps.Map(_this.arParams.mapID, _this.arParams.YandexDefaultOption);

		/*_this.arParams.map.controls
			.add('zoomControl')
			.add('typeSelector')
			.add('mapTools')
		;*/

		_this.arParams.Collection = new ymaps.GeoObjectCollection();

		let sections = _this.arParams.mainBlockSelector.querySelectorAll(_this.arParams.sectionSelector);

		Array.prototype.slice.call(sections).forEach(function(element) {
			element.addEventListener('click', function() {
				_this.getBranches(element.dataset.id);
				_this.toggleActionList(element, sections);
			});
		});

		let activeSection = _this.arParams.mainBlockSelector.querySelector('.geoItems__section.active');
		_this.getBranches(activeSection.dataset.id);
		_this.toggleActionList(activeSection, sections);
	});


}