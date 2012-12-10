var canvas;
var ctx;
var canvasX;
var canvasY;
var mouseIsDown = 0;

var plot;
var plotOffset;
var plotPosition;
var graphData = [];

function init() {
	canvas = document.getElementById("sketchpad");
	if (canvas) {
		ctx = canvas.getContext("2d");
		
		canvas.addEventListener("mousedown", mouseDown, false);
		canvas.addEventListener("mousemove", mouseXY, false);
		canvas.addEventListener("touchstart", touchDown, false);
		canvas.addEventListener("touchmove", touchXY, true);
		canvas.addEventListener("touchend", touchUp, false);
		
		document.body.addEventListener("mouseup", mouseUp, false);
		document.body.addEventListener("touchcancel", touchUp, false);
	}
}

function mouseUp(e) {
	mouseIsDown = 0;
	mouseXY(e);
}

function touchUp() {
	mouseIsDown = 0;
	showPos();
}

function mouseDown(e) {
	mouseIsDown = 1;
	mouseXY(e);
}

function touchDown(e) {
	mouseIsDown = 1;
	touchXY(e);
}

function mouseXY(e) {
	e.preventDefault();
	canvasX = e.pageX - canvas.offsetLeft;
	canvasY = e.pageY - canvas.offsetTop;
	showPos();
}

function touchXY(e) {
	e.preventDefault();
	canvasX = e.targetTouches[0].pageX - canvas.offsetLeft;
	canvasY = e.targetTouches[0].pageY - canvas.offsetTop;
	showPos();
}

function showPos() {
	ctx.clearRect(0,0, canvas.width,canvas.height);

	if (mouseIsDown) {
		var position = {
			x: (canvasX - plotOffset.left) / plotDimensions.x,
			y: (canvasY - plotOffset.top) / plotDimensions.y
		};

		if (position.x >= 0 &&
			position.y >= 0 &&
			position.x <= 1 &&
			position.y <= 1)
		{
			graphData.push([position.x, 1 - 2 * position.y]);
			plot.setData([graphData]);
			plot.draw();
		}
	}
}

window.addEventListener('load', init, false);

$(function () {
	var graph = $('#graph');
	if (graph.length > 0) {
		// Set up plot
		var options = {
			xaxis: { show: false, min: 0, max: 1 },
			yaxis: { show: false, min: -1, max: 1 }
		};
		plot = $.plot(graph, [ graphData ], options);
		diary_onResize();
		
		graph.resize(function() {
			diary_onResize();
		});
	}
});

function diary_onResize() {
	// Ensure that the graph takes up as much area as possible.
	var contentContainer = $('.ui-content');
	var containerBottomPosition = contentContainer.offset().top + contentContainer.outerHeight(true);
	var footerTop = $('.ui-footer').offset().top;
	var difference = footerTop - containerBottomPosition;
	if (difference != 0) {
		console.log(containerBottomPosition + ' ? ' + footerTop);
		var graph = $('#mood-graph');
		graph.css('height', graph.height() + difference);
	}

	// Recalculate the size of the plot for the pointer detection.
	plotOffset = plot.offset();
	plotDimensions = {x: plot.width(), y: plot.height()};
}