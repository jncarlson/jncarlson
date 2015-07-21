<html lang="en">
<head>

    <meta charset="utf-8">

    <title>D3js - Joseph Carlson</title>

    <meta name="description" content="Work and tutorials by Joseph Carlson">
    <meta name="keywords" content="code, programming, design, d3, js, jquery">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" type="text/css" media="screen" href="http://jncarlson.com/assets/css/screen.css">
    <link rel="stylesheet" type="text/css" media="screen" href="http://jncarlson.com/assets/css/tutorial.css">
    <link rel="stylesheet" type="text/css" media="screen and (max-device-width: 480px)" href="http://jncarlson.com/assets/css/narrow.css">
    <meta name="viewport" content="initial-scale=1.0">



    <style type="text/css"></style></head>

<body class="tutorial">

<header>
    <h1><a href="http://jncarlson.com/">Joe Carlson</a><span class="prof">, Web Engineer</span></h1>
    <nav>
        <ul>
            <li><a href="http://jncarlson.com/about.html">About</a></li>
            <li><a href="http://jncarlson.com/index.html">Work</a></li>
            <li><a class="active" href="http://jncarlson.com/tutorials.html">Tutorials</a></li>
            <li><a href="http://linkedin.com/pub/joseph-carlson/93/100/a71">LinkedIn</a></li>
            <li><a href="http://jncarlson.com/contact.html">Contact</a></li>
            <li><a href="https://github.com/RockStarTower.html">Git Hub</a></li>
        </ul>
    </nav>	</header>

<!--[if lte IE 8]>
<div id="ie_warning"><strong>You&rsquo;re using an old version of Internet Explorer.</strong> Consider upgrading your browser to <a href="http://www.apple.com/safari/">Safari</a>, <a href="http://www.mozilla.org/en-US/firefox/new/">Firefox</a>, or <a href="http://www.google.com/chrome">Chrome</a>, and experience a more beautiful web!</div>
<![endif]-->

<noscript>
    &lt;div id="js_warning"&gt;&lt;strong&gt;JavaScript is turned off, so this page won&amp;rsquo;t be very interactive.&lt;/strong&gt; Switch JavaScript back on in your web browser for the full experience.&lt;/div&gt;
</noscript>





<h3>
    <a href="http://jncarlson.com/index.html">Work</a> &gt;
    D3 Bar Chart</h3>

<h2>D3 Bar Chart</h2>
<div id="text">
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <div id="barChart">

    </div>
    <h2>Description</h2>
    <p>
        This is a simple bar chart made entirely with d3 that represents tasks completed by team each month. The chart is fully scalable. You can add new objects to the array with different data and each bar will automatically adjust in width and size to display the information accurately in the canvas size given.
    </p>
    <p>
        The bar chart also has dynamic coloring. The larger the number is the more blue the bars are, smaller the number the more black. Creating a chart with a scalable vector means you can zoom in on your browser and the image will recalculate and always look sharp. I also added a transition on loading for the bar heights and text placement. You can scroll further down to see an example of this bar chart transitioning to new data.
    </p>
    <h2>d3 and Data Structure</h2>
	<pre>
		<code>
            "var dataset = [

            {
            "Team": "Domain Purchase",
            "CompletedMonth": 500,
            "CompletedWeek": 341,
            "Pending": 615
            },
            {
            "Team": "Content Strategy",
            "CompletedMonth": 772,
            "CompletedWeek": 187,
            "Pending": 843
            },
            {
            "Team": "Copy Writing",
            "CompletedMonth": 690,
            "CompletedWeek": 83,
            "Pending": 351
            },
            {
            "Team": "Copy Review",
            "CompletedMonth": 702,
            "CompletedWeek": 89,
            "Pending": 30
            },
            {
            "Team": "Design",
            "CompletedMonth": 86,
            "CompletedWeek": 5,
            "Pending": 708
            },
            {
            "Team": "Content and Design QA",
            "CompletedMonth": 89,
            "CompletedWeek": 5,
            "Pending": 6
            },
            {
            "Team": "Development",
            "CompletedMonth": 170,
            "CompletedWeek": 51,
            "Pending": 15
            },
            {
            "Team": "Post Build QA",
            "CompletedMonth": 163,
            "CompletedWeek": 92,
            "Pending": 5
            }

            ];

            var w = 500;
            var h = d3.max(dataset, function(d) {
            return d.CompletedMonth / 3;
            });

            var color = d3.scale.linear()
            .domain([-300, d3.max(dataset, function(d) {
            return d.CompletedMonth;
            })])
            .range(["black", "blue"]);

            var barPadding = 3;
            var margin = {top: 20, right: 20, bottom: 70, left: 40},
            width = 600 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom;


            var y = d3.scale.linear()
            .range([h, 0])
            .domain([0, d3.max(dataset, function(d) {
            return d.CompletedMonth;
            })]);

            var x = d3.scale.ordinal()
            .domain(dataset.map(function(d) {
            return d.Team;
            }))
            .rangeBands([0, w, w]);

            var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);

            var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

            var svg = d3.select("#barChart")
            .append("svg")
            .attr("width", w)
            .attr("height", h)
            .style("padding-left", 50)
            .style("padding", 50)
            .style("padding-bottom", 150);


            svg.selectAll("svg")
            .data(dataset)
            .enter()
            .append("rect")
            .attr("height", 10)
            .style("opacity", .7)
            .attr("transform", "rotate(180)")
            .attr("y", -h)
            .attr("x", function(d, i) {
            return -(i * (w / dataset.length) + 85);
            })
            .transition()
            .delay(function(d, i) { return i * 300})
            .duration(300)
            .style("opacity", 1)
            .attr("width", w / dataset.length - barPadding)
            .attr("height", function(d) {
            return d.CompletedMonth / 3;
            })
            .attr("fill", function(d) {
            return color(d.CompletedMonth);
            });

            svg.selectAll("text")
            .data(dataset)
            .enter()
            .append("text")
            .attr("fill", "white")
            .attr("fill", "white")
            .attr("font-family", "sans-serif")
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle")
            .attr("opacity", 0)
            .transition()
            .delay(3000)
            .duration(450)
            .text(function(d) {
            return d.CompletedMonth;
            })
            .attr("x", function(d, i) {
            return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
            })
            .attr("y", function(d) {
            return h - (d.CompletedMonth / 3) + 20 ;
            })
            .attr("font-family", "sans-serif")
            .attr("opacity", 1)
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle");

            svg.append("g")
            .data(dataset)
            .call(yAxis)
            .attr("class", "axis")
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Completed Tasks / Month");

            svg.append("g")
            .attr("class", "xaxis")
            .call(xAxis)
            .attr("transform", "translate(25," + (h + 5) + ")")
            .selectAll("text")
            .attr("transform", "rotate(-55)")
            .attr("x", -10)
            .style("stroke-width", "1px")
            .style("text-anchor", "end");"
        </code>
	</pre>
    <h2>With Transition</h2>
    <p>
        This time I added two buttons that show what a transition does. We use the same JSON array and set of object, but now instead of looking at the month view we will transition into the week view. I kept the same scale (the Y axis) for reference. Click the "week" button below to activate it. You can click month to transition it back.
    </p>
    <p>
        In this transition, the label key on the y-axis is changed to "week", each bar resizes, the bar colors change, and the values for each bar are updated.
    </p>
    <button class="transition" id="CompletedWeek" >Week</button>
    <button class="transition" id="CompletedMonth" >Month</button>
    <div id="barTransition">

    </div>
    <h2>Update Function</h2>
    <p>
        In order to update the chart I needed to add two functions. One that executes when you click one of the buttons (week or month). And another that actually tells it what to do to update the information.
    </p>
    <p>
        d3 works by creating elements and then binding attributes to them. You can see this by inspecting the page. There will be a lot of HTML elements with attributes and values bound to them. To update this information, we don't want to start from scratch, we want to take the information already there and change the values. The transition method is what creates the smooth animated effect.
    </p>
    <p>
		<pre>
			<code>
                d3.selectAll(".transition").on("click", function(){
                var timeData = d3.select(this).attr("id");
                updateData(dataset, timeData);
                });
            </code>
		</pre>
    <p>
        The code above selects all the elements with the class of "transition", then it runs a function that finds the id of the specific element you clicked on, that id is set to a variable named <code>timeData</code>. <code>timeData</code> is then passed as the second argument to the function <code>updateData</code>.
    <p>
    <p>
        To make more sense of this, here is the html for the two buttons. You can see the classes are the same, but the id contains the value we want to have passed to be used as that second argument.
    </p>
    <p>
		<pre>
			<code>
                &lt;button&gt; class="transition" id="CompletedWeek" >Week&lt;/button&gt;
                &lt;button&gt; class="transition" id="CompletedMonth" >Month&lt;/button&gt;
            </code>
		</pre>
    </p>
    <h2>Update Function Code</h2>
    <p>
		<pre>
			<code>
                function updateData(dataset, timeData) {

                var color = d3.scale.linear()
                .domain([-300, d3.max(dataset, function(d) {
                return d[timeData];
                })])
                .range(["black", "blue"]);

                var y = d3.scale.linear()
                .range([h, 0])
                .domain([0, d3.max(dataset, function(d) {
                return d.CompletedMonth;
                })]);

                var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .ticks(10);

                svg.selectAll("rect")
                .data(dataset)
                .transition()
                .delay(function(d, i) { return i * 300})
                .duration(750)
                .attr("height", function(d) {
                return d[timeData] / 3;
                })
                .attr("fill", function(d) {
                return color(d[timeData]);
                });

                svg.selectAll("text")
                .data(dataset)
                .transition()
                .delay(function(d, i) { return i * 300})
                .duration(750)
                .text(function(d) {
                return d[timeData];
                })
                .attr("x", function(d, i) {
                return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
                })
                .attr("y", function(d) {
                return h - (d[timeData] / 3) + 20 ;
                });

                if (timeData == "CompletedWeek"){

                svg.selectAll(".timePeriod")
                .data(dataset)
                .call(yAxis)
                .attr("class", "timePeriod")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Completed Tasks / Week");

                } else {

                svg.selectAll(".timePeriod")
                .data(dataset)
                .call(yAxis)
                .attr("class", "timePeriod")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Completed Tasks / Month");

                }
            </code>
		</pre>
    </p>
    <h2>Automated Transition</h2>
    <p>
        Finally, and mostly for fun, here is the bar chart cycling through each view all on it's own. I also added the "pending" view, from the array. So now it cycles through 3 views total. On top of that each one has it's own color scheme.
    </p>
    <div id="automated">

    </div>
    <p>
        Below is the code that triggers the transition. It does this by cycling through each if statement that calls the function with a different argument. The refresh period is set to 5 seconds.
    </p>
    <p>
		<pre>
			<code>
                var timeData = "CompletedWeek";
                window.setInterval(function(){

                if (timeData == "CompletedWeek") {
                updateData(dataset, timeData);
                timeData = "CompletedMonth";
                } else if (timeData == "CompletedMonth") {
                updateData(dataset, timeData);
                timeData = "Pending";
                } else if (timeData == "Pending") {
                timeData = "Pending";
                updateData(dataset, timeData);
                timeData = "CompletedWeek";
                }

                }, 5000);
            </code>
		</pre>
    </p>

    <style>

        .axis path {
            fill: none;
            stroke-width: 1;
            stroke: black;
            shape-rendering: crispEdges;
        }

        .axis line{
            fill: black;
            stroke: black;
        }

        .axis text {
            font-family: sans-serif;
            font-size: 13px;
        }

        .xaxis path {
            fill: none;
            stroke: black;
            stroke-width: 1;
            shape-rendering: crispEdges;
        }

        .xaxis line{
            fill: black;
            stroke: black;
        }

        .xaxis text {
            font-family: sans-serif;
            font-size: 11px;
            font-weight: bold;
        }




    </style>

    <script>


        var dataset = [

            {

                "Team": "Domain Purchase",
                "CompletedMonth": 500,
                "CompletedWeek": 341,
                "Pending": 615

            },
            {

                "Team": "Content Strategy",
                "CompletedMonth": 772,
                "CompletedWeek": 187,
                "Pending": 843

            },
            {

                "Team": "Copy Writing",
                "CompletedMonth": 690,
                "CompletedWeek": 83,
                "Pending": 351

            },
            {

                "Team": "Copy Review",
                "CompletedMonth": 702,
                "CompletedWeek": 89,
                "Pending": 30

            },
            {

                "Team": "Design",
                "CompletedMonth": 86,
                "CompletedWeek": 5,
                "Pending": 708

            },
            {

                "Team": "Content and Design QA",
                "CompletedMonth": 89,
                "CompletedWeek": 5,
                "Pending": 6

            },
            {

                "Team": "Development",
                "CompletedMonth": 170,
                "CompletedWeek": 51,
                "Pending": 15

            },
            {

                "Team": "Post Build QA",
                "CompletedMonth": 163,
                "CompletedWeek": 92,
                "Pending": 5

            }

        ];

        var w = 500;
        var h = d3.max(dataset, function(d) {
            return d.CompletedMonth / 3;
        });

        var color = d3.scale.linear()
            .domain([-300, d3.max(dataset, function(d) {
                return d.CompletedMonth;
            })])
            .range(["black", "blue"]);

        var barPadding = 3;
        var margin = {top: 20, right: 20, bottom: 70, left: 40},
            width = 600 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom;


        var y = d3.scale.linear()
            .range([h, 0])
            .domain([0, d3.max(dataset, function(d) {
                return d.CompletedMonth;
            })]);

        var x = d3.scale.ordinal()
            .domain(dataset.map(function(d) {
                return d.Team;
            }))
            .rangeBands([0, w, w]);

        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);

        var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

        var svg = d3.select("#barChart")
            .append("svg")
            .attr("width", w)
            .attr("height", h)
            .style("padding-left", 50)
            .style("padding", 50)
            .style("padding-bottom", 150);


        svg.selectAll("svg")
            .data(dataset)
            .enter()
            .append("rect")
            .attr("height", 10)
            .style("opacity", .7)
            .attr("transform", "rotate(180)")
            .attr("y", -h)
            .attr("x", function(d, i) {
                return -(i * (w / dataset.length) + 85);
            })
            .transition()
            .delay(function(d, i) { return i * 300})
            .duration(750)
            .style("opacity", 1)
            .attr("width", w / dataset.length - barPadding)
            .attr("height", function(d) {
                return d.CompletedMonth / 3;
            })
            .attr("fill", function(d) {
                return color(d.CompletedMonth);
            });

        svg.selectAll("text")
            .data(dataset)
            .enter()
            .append("text")
            .attr("fill", "white")
            .attr("fill", "white")
            .attr("font-family", "sans-serif")
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle")
            .attr("opacity", 0)
            .transition()
            .delay(3000)
            .duration(450)
            .text(function(d) {
                return d.CompletedMonth;
            })
            .attr("x", function(d, i) {
                return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
            })
            .attr("y", function(d) {
                return h - (d.CompletedMonth / 3) + 20 ;
            })
            .attr("opacity", 1)
            .attr("font-family", "sans-serif")
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle");

        svg.append("g")
            .data(dataset)
            .call(yAxis)
            .attr("class", "axis")
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Completed Tasks / Month");

        svg.append("g")
            .attr("class", "xaxis")
            .call(xAxis)
            .attr("transform", "translate(25," + (h + 5) + ")")
            .selectAll("text")
            .attr("transform", "rotate(-55)")
            .attr("x", -10)
            .style("stroke-width", "1px")
            .style("text-anchor", "end");

    </script>

    <script>

        var dataset = [

            {

                "Team": "Domain Purchase",
                "CompletedMonth": 500,
                "CompletedWeek": 341,
                "Pending": 615

            },
            {

                "Team": "Content Strategy",
                "CompletedMonth": 772,
                "CompletedWeek": 187,
                "Pending": 843

            },
            {

                "Team": "Copy Writing",
                "CompletedMonth": 690,
                "CompletedWeek": 83,
                "Pending": 351

            },
            {

                "Team": "Copy Review",
                "CompletedMonth": 702,
                "CompletedWeek": 89,
                "Pending": 30

            },
            {

                "Team": "Design",
                "CompletedMonth": 86,
                "CompletedWeek": 5,
                "Pending": 708

            },
            {

                "Team": "Content and Design QA",
                "CompletedMonth": 89,
                "CompletedWeek": 5,
                "Pending": 6

            },
            {

                "Team": "Development",
                "CompletedMonth": 170,
                "CompletedWeek": 51,
                "Pending": 15

            },
            {

                "Team": "Post Build QA",
                "CompletedMonth": 163,
                "CompletedWeek": 92,
                "Pending": 5

            }


        ];

        // Here we set the varibales for the height and width of the canvas.
        // The function that decides the canvas height finds the max value of
        // "CompletedMonth" in the array, and sets the h variable to that.
        // I also devided the max value by 3 to not make the graph too tall.
        var w = 500;
        var h = d3.max(dataset, function(d) {
            return d.CompletedMonth / 3;
        });

        // The color varible is set to a linear scale. The domain is set to decide
        // How much the values of the range will be. The range is the two different
        // to pick from.
        var color = d3.scale.linear()
            .domain([-300, d3.max(dataset, function(d) {
                return d.CompletedMonth;
            })])
            .range(["black", "blue"]);

        // A few varibles here to keep margins/paddings tidy
        var barPadding = 3;
        var margin = {top: 20, right: 20, bottom: 70, left: 40},
            width = 600 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom;

        // Here we set another linear scale for the Y axis. The range is going to be
        // as tall as the height of the canvas. The domain will go from 0 to the max value
        var y = d3.scale.linear()
            .range([h, 0])
            .domain([0, d3.max(dataset, function(d) {
                return d.CompletedMonth;
            })]);

        // Since the x value is just labels, we pick an ordinal scale. Then set it
        // to a function that finds all the team names. The rangeBands method works
        // at deciding the spacing and margins of those labels
        var x = d3.scale.ordinal()
            .domain(dataset.map(function(d) {
                return d.Team;
            }))
            .rangeBands([0, w, w]);

        // Here we set the y and x scales to the axis of the svg for later use.
        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);

        var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom");

        // Now we are selecting the "body" element and appending an "svg" element to it
        // We are giving it various attributes, including width and height, set to the
        // variables we made earlier. All of this is assigned to a variable called "svg".
        var svg = d3.select("#barTransition")
            .append("svg")
            .attr("width", w)
            .attr("height", h)
            .style("padding-left", 50)
            .style("padding", 50)
            .style("padding-bottom", 150);

        // Now we are grabbing that svg variable and giving it more attributes and instructions.
        // we select the svg, give it the data of arrays, tell it to make a rectangle for each
        // element.
        svg.selectAll("svg")
            .data(dataset)
            .enter()
            .append("rect")
            .attr("height", 10)
            .style("opacity", .7)
            .attr("transform", "rotate(180)")
            .attr("y", -h)
            .attr("x", function(d, i) {
                return -(i * (w / dataset.length) + 85);
            })
            .transition()
            .delay(function(d, i) { return i * 300})
            .duration(750)
            .style("opacity", 1)
            .attr("width", w / dataset.length - barPadding)
            .attr("height", function(d) {
                return d.CompletedMonth / 3;
            })
            .attr("fill", function(d) {
                return color(d.CompletedMonth);
            });

        // This function, and the one below it are for the "transition" button. They grab the
        // current values binded to the elements, and update them with a transition effect.
        d3.selectAll(".transition").on("click", function(){
            var timeData = d3.select(this).attr("id");
            updateData(dataset, timeData);
        });

        function updateData(dataset, timeData) {

            var color = d3.scale.linear()
                .domain([-300, d3.max(dataset, function(d) {
                    return d[timeData];
                })])
                .range(["black", "blue"]);

            var y = d3.scale.linear()
                .range([h, 0])
                .domain([0, d3.max(dataset, function(d) {
                    return d.CompletedMonth;
                })]);

            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .ticks(10);

            svg.selectAll("rect")
                .data(dataset)
                .transition()
                .delay(function(d, i) { return i * 300})
                .duration(750)
                .attr("height", function(d) {
                    return d[timeData] / 3;
                })
                .attr("fill", function(d) {
                    return color(d[timeData]);
                });

            svg.selectAll("text")
                .data(dataset)
                .transition()
                .delay(function(d, i) { return i * 300})
                .duration(750)
                .attr("opacity", 1)
                .text(function(d) {
                    return d[timeData];
                })
                .attr("x", function(d, i) {
                    return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
                })
                .attr("y", function(d) {
                    return h - (d[timeData] / 3) + 20 ;
                });

            if (timeData == "CompletedWeek"){

                svg.selectAll(".timePeriod")
                    .data(dataset)
                    .call(yAxis)
                    .attr("class", "axis")
                    .attr("class", "timePeriod")
                    .attr("transform", "rotate(-90)")
                    .attr("y", 6)
                    .attr("dy", ".71em")
                    .style("text-anchor", "end")
                    .text("Completed Tasks / Week");

            } else {

                svg.selectAll(".timePeriod")
                    .data(dataset)
                    .call(yAxis)
                    .attr("class", "axis")
                    .attr("class", "timePeriod")
                    .attr("transform", "rotate(-90)")
                    .attr("y", 6)
                    .attr("dy", ".71em")
                    .style("text-anchor", "end")
                    .text("Completed Tasks / Month");

            }

        };

        // This is what adds the number labels on the top of each bar. We first create a text
        // element for each bar, then have it iterate through each number for the view we are
        // looking at. The transition delays the text to be added after the bars appear.
        svg.selectAll("text")
            .data(dataset)
            .enter()
            .append("text")
            .attr("fill", "white")
            .attr("fill", "white")
            .attr("font-family", "sans-serif")
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle")
            .attr("opacity", 0)
            .transition()
            .delay(3000)
            .duration(450)
            .text(function(d) {
                return d.CompletedMonth;
            })
            .attr("x", function(d, i) {
                return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
            })
            .attr("y", function(d) {
                return h - (d.CompletedMonth / 3) + 20 ;
            })
            .attr("font-family", "sans-serif")
            .attr("opacity", 1)
            .attr("font-size", "11px")
            .attr("fill", "white")
            .attr("text-anchor", "middle");

        // This is where we use those xAxis and yAxis variables we set way up top.
        // append "g" means we are creating a group element and using that for the axis.
        // Most the styling and attributes are just to make the axis look visually best
        // with the graph we are building.
        svg.append("g")
            .data(dataset)
            .call(yAxis)
            .attr("class", "axis")
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .attr("class", "timePeriod")
            .text("Completed Tasks / Month");

        svg.append("g")
            .attr("class", "xaxis")
            .call(xAxis)
            .attr("transform", "translate(25," + (h + 5) + ")")
            .selectAll("text")
            .attr("transform", "rotate(-55)")
            .attr("x", -15)
            .style("stroke-width", "1px")
            .style("text-anchor", "end");

    </script>

    <script>



        function chart2(){
            var dataset = [

                {

                    "Team": "Domain Purchase",
                    "CompletedMonth": 500,
                    "CompletedWeek": 341,
                    "Pending": 615

                },
                {

                    "Team": "Content Strategy",
                    "CompletedMonth": 772,
                    "CompletedWeek": 187,
                    "Pending": 843

                },
                {

                    "Team": "Copy Writing",
                    "CompletedMonth": 690,
                    "CompletedWeek": 83,
                    "Pending": 351

                },
                {

                    "Team": "Copy Review",
                    "CompletedMonth": 702,
                    "CompletedWeek": 89,
                    "Pending": 30

                },
                {

                    "Team": "Design",
                    "CompletedMonth": 86,
                    "CompletedWeek": 5,
                    "Pending": 708

                },
                {

                    "Team": "Content and Design QA",
                    "CompletedMonth": 89,
                    "CompletedWeek": 5,
                    "Pending": 6

                },
                {

                    "Team": "Development",
                    "CompletedMonth": 170,
                    "CompletedWeek": 51,
                    "Pending": 15

                },
                {

                    "Team": "Post Build QA",
                    "CompletedMonth": 163,
                    "CompletedWeek": 92,
                    "Pending": 5

                }


            ];

            var w = 500;
            var h = d3.max(dataset, function(d) {
                return d.CompletedMonth / 3;
            });


            var color = d3.scale.linear()
                .domain([-300, d3.max(dataset, function(d) {
                    return d.CompletedMonth;
                })])
                .range(["black", "blue"]);

            // A few varibles here to keep margins/paddings tidy
            var barPadding = 3;
            var margin = {top: 20, right: 20, bottom: 70, left: 40},
                width = 600 - margin.left - margin.right,
                height = 300 - margin.top - margin.bottom;


            var y = d3.scale.linear()
                .range([h, 0])
                .domain([0, d3.max(dataset, function(d) {
                    return d.CompletedMonth;
                })]);


            var x = d3.scale.ordinal()
                .domain(dataset.map(function(d) {
                    return d.Team;
                }))
                .rangeBands([0, w, w]);


            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .ticks(10);

            var xAxis = d3.svg.axis()
                .scale(x)
                .orient("bottom");


            var svg = d3.select("#automated")
                .append("svg")
                .attr("width", w)
                .attr("height", h)
                .style("padding-left", 50)
                .style("padding", 50)
                .style("padding-bottom", 150);


            svg.selectAll("svg")
                .data(dataset)
                .enter()
                .append("rect")
                .attr("height", 10)
                .style("opacity", .7)
                .attr("transform", "rotate(180)")
                .attr("y", -h)
                .attr("x", function(d, i) {
                    return -(i * (w / dataset.length) + 85);
                })
                .transition()
                .delay(function(d, i) { return i * 300})
                .duration(750)
                .style("opacity", 1)
                .attr("width", w / dataset.length - barPadding)
                .attr("height", function(d) {
                    return d.CompletedMonth / 3;
                })
                .attr("fill", function(d) {
                    return color(d.CompletedMonth);
                });

            var timeData = "CompletedWeek";
            window.setInterval(function(){

                if (timeData == "CompletedWeek") {
                    updateData(dataset, timeData);
                    timeData = "CompletedMonth";
                } else if (timeData == "CompletedMonth") {
                    updateData(dataset, timeData);
                    timeData = "Pending";
                } else if (timeData == "Pending") {
                    timeData = "Pending";
                    updateData(dataset, timeData);
                    timeData = "CompletedWeek";
                }

            }, 5000);

            function updateData(dataset, timeData) {

                if (timeData == "CompletedMonth") {

                    var color = d3.scale.linear()
                        .domain([-300, d3.max(dataset, function(d) {
                            return d[timeData];
                        })])
                        .range(["black", "blue"]);

                } else if (timeData == "CompletedWeek") {

                    var color = d3.scale.linear()
                        .domain([-300, d3.max(dataset, function(d) {
                            return d[timeData];
                        })])
                        .range(["black", "teal"]);

                } else if (timeData == "Pending") {

                    var color = d3.scale.linear()
                        .domain([-300, d3.max(dataset, function(d) {
                            return d[timeData];
                        })])
                        .range(["black", "grey"]);

                }

                var y = d3.scale.linear()
                    .range([h, 0])
                    .domain([0, d3.max(dataset, function(d) {
                        return d.CompletedMonth;
                    })]);

                var yAxis = d3.svg.axis()
                    .scale(y)
                    .orient("left")
                    .ticks(10);

                svg.selectAll("rect")
                    .data(dataset)
                    .transition()
                    .delay(function(d, i) { return i * 300})
                    .duration(750)
                    .attr("height", function(d) {
                        return d[timeData] / 3;
                    })
                    .attr("fill", function(d) {
                        return color(d[timeData]);
                    });

                svg.selectAll("text")
                    .data(dataset)
                    .transition()
                    .delay(function(d, i) { return i * 300})
                    .duration(750)
                    .attr("opacity", 1)
                    .text(function(d) {
                        return d[timeData];
                    })
                    .attr("x", function(d, i) {
                        return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
                    })
                    .attr("y", function(d) {
                        return h - (d[timeData] / 3) + 20 ;
                    });

                if (timeData == "CompletedWeek"){

                    svg.selectAll(".timePeriod")
                        .data(dataset)
                        .call(yAxis)
                        .attr("class", "axis")
                        .attr("class", "timePeriod")
                        .attr("transform", "rotate(-90)")
                        .attr("y", 6)
                        .attr("dy", ".71em")
                        .style("text-anchor", "end")
                        .text("Completed Tasks / Week");

                } else if (timeData == "CompletedMonth") {

                    svg.selectAll(".timePeriod")
                        .data(dataset)
                        .call(yAxis)
                        .attr("class", "axis")
                        .attr("class", "timePeriod")
                        .attr("transform", "rotate(-90)")
                        .attr("y", 6)
                        .attr("dy", ".71em")
                        .style("text-anchor", "end")
                        .text("Completed Tasks / Month");

                } else {

                    svg.selectAll(".timePeriod")
                        .data(dataset)
                        .call(yAxis)
                        .attr("class", "axis")
                        .attr("class", "timePeriod")
                        .attr("transform", "rotate(-90)")
                        .attr("y", 6)
                        .attr("dy", ".71em")
                        .style("text-anchor", "end")
                        .text("Pending Tasks");
                }
            };

            svg.selectAll("text")
                .data(dataset)
                .enter()
                .append("text")
                .attr("fill", "white")
                .attr("font-family", "sans-serif")
                .attr("font-size", "11px")
                .attr("fill", "white")
                .attr("text-anchor", "middle")
                .attr("opacity", 0)
                .transition()
                .delay(3000)
                .attr("opacity", 1)
                .text(function(d) {
                    return d.CompletedMonth;
                })
                .attr("x", function(d, i) {
                    return (i * (w / dataset.length) + (w / dataset.length - barPadding) / 2) + 25;
                })
                .attr("y", function(d) {
                    return h - (d.CompletedMonth / 3) + 20 ;
                })
                .attr("font-family", "sans-serif")
                .attr("font-size", "11px")
                .attr("fill", "white")
                .attr("text-anchor", "middle");

            svg.append("g")
                .data(dataset)
                .call(yAxis)
                .attr("class", "axis")
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .attr("class", "timePeriod")
                .text("Completed Tasks / Month");

            svg.append("g")
                .attr("class", "xaxis")
                .call(xAxis)
                .attr("transform", "translate(25," + (h + 5) + ")")
                .selectAll("text")
                .attr("transform", "rotate(-55)")
                .attr("x", -15)
                .style("stroke-width", "1px")
                .style("text-anchor", "end");
        };
        chart2();
    </script>

</div>

</body></html>