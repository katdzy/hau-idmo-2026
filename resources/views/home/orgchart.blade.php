@extends('layouts.main')

@section('title', 'Organizational Chart')

@section('content')
    <!-- Image Banner Title -->
    <div class="relative bg-gray-100 overflow-hidden">
        <img src="{{ asset('images/hau-bg.png') }}" alt="HAU Campus Banner" 
             class="w-full h-64 md:h-80 lg:h-96 object-fill">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                    Office of Institutional Effectiveness
                </h1>
                <p class="text-lg md:text-2xl opacity-90">
                    Organizational Chart
                </p>
            </div>
        </div>
    </div>

    <!-- Organizational Chart -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div id="orgchart" style="width: 100%; height: 600px; position: relative;"></div>
    </div>

    <!-- D3.js Script -->
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script>
        function createOrgChart() {
            // Clear any existing chart
            d3.select("#orgchart").selectAll("*").remove();

            const width = document.getElementById('orgchart').offsetWidth;
            const height = 600;

            // Create SVG
            const svg = d3.select("#orgchart")
                .append("svg")
                .attr("width", width)
                .attr("height", height);

            // Define the organizational data with exact positions
            const orgData = [
                // Top level - Director
                {
                    id: "director",
                    name: "Engr. Anne Marie A. Mangiliman",
                    title: "OIC - Director, Institutional Effectiveness",
                    x: width / 2,
                    y: 100,
                    image: "{{ asset('images/profiles/director.jpg') }}"
                },
                // Second level - Department heads
                {
                    id: "qa",
                    name: "Dr. Alma Theresa D. Manaloto",
                    title: "Head, Quality Assurance",
                    x: width * 0.2,
                    y: 300,
                    parent: "director",
                    image: "{{ asset('images/profiles/qa.jpg') }}"
                },
                {
                    id: "planning",
                    name: "Engr. Anne Marie A. Mangiliman",
                    title: "Head, Institutional Planning, Research and Publications Office",
                    x: width * 0.4,
                    y: 300,
                    parent: "director",
                    image: "{{ asset('images/profiles/planning.jpg') }}"
                },
                {
                    id: "database",
                    name: "Engr. Maria Elena Y. Timbang",
                    title: "Head, Database Management Office",
                    x: width * 0.6,
                    y: 300,
                    parent: "director",
                    image: "{{ asset('images/profiles/database.jpg') }}"
                },
                {
                    id: "document",
                    name: "Ms. Corazon Q. Mallari",
                    title: "Institutional Document Controller",
                    x: width * 0.8,
                    y: 300,
                    parent: "director",
                    image: "{{ asset('images/profiles/document.jpg') }}"
                },
                // Third level - Staff
                {
                    id: "staff1",
                    name: "Ms. Bianca Ysabel L. Navarro",
                    title: "Staff, Institutional Planning, Research and Publications Office",
                    x: width * 0.4,
                    y: 500,
                    parent: "planning",
                    image: "{{ asset('images/profiles/staff1.jpg') }}"
                },
                {
                    id: "staff2",
                    name: "Staff",
                    title: "Staff, Institutional Document Controller",
                    x: width * 0.8,
                    y: 500,
                    parent: "document",
                    image: "{{ asset('images/profiles/staff2.jpg') }}"
                }
            ];

            // Create connections - we need to draw them in a specific order
            const midY1 = 220; // First horizontal line for QA, Planning, Database (lower)
            const midY2 = 180; // Second horizontal line for IDC (higher/above)
            
            // Main vertical line from director
            svg.append("path")
                .attr("class", "connection main-vertical")
                .attr("d", `M ${width / 2} ${100 + 60} L ${width / 2} ${midY2 + 40}`) // Extended to go past IDC branch
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3)
                .attr("fill", "none");
            
            // First horizontal line for QA, Planning, Database (3 departments)
            svg.append("path")
                .attr("class", "connection horizontal-line-1")
                .attr("d", `M ${width / 2} ${midY1} L ${width * 0.6} ${midY1}`) // From center to Database position
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3)
                .attr("fill", "none");
                
            // Extend first horizontal line to the left for QA and Planning
            svg.append("path")
                .attr("class", "connection horizontal-line-1-left")
                .attr("d", `M ${width / 2} ${midY1} L ${width * 0.2} ${midY1}`) // From center to QA position
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3)
                .attr("fill", "none");
            
            // Second horizontal line for IDC
            svg.append("path")
                .attr("class", "connection horizontal-line-2")
                .attr("d", `M ${width / 2} ${midY2} L ${width * 0.8} ${midY2}`) // From center to IDC position
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3)
                .attr("fill", "none");
            
            // Vertical lines down to first 3 departments
            const firstThreeDepts = [
                { x: width * 0.201, y: midY1 },      // QA
                { x: width * 0.4, y: midY1 },      // Planning
                { x: width * 0.599, y: midY1 }       // Database
            ];
            
            firstThreeDepts.forEach(dept => {
                svg.append("path")
                    .attr("class", "connection vertical-to-dept-1")
                    .attr("d", `M ${dept.x} ${dept.y} L ${dept.x} ${300 - 60}`)
                    .attr("stroke", "#5c542c")
                    .attr("stroke-width", 3)
                    .attr("fill", "none");
            });
            
            // Vertical line down to IDC
            svg.append("path")
                .attr("class", "connection vertical-to-idc")
                .attr("d", `M ${width * 0.799} ${midY2} L ${width * 0.8} ${300 - 60}`)
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3)
                .attr("fill", "none");
            
            // Draw connections from departments to their staff
            const staffConnections = [
                { from: orgData.find(n => n.id === "planning"), to: orgData.find(n => n.id === "staff1") },
                { from: orgData.find(n => n.id === "document"), to: orgData.find(n => n.id === "staff2") }
            ];
            
            staffConnections.forEach(conn => {
                const midStaffY = conn.from.y + (conn.to.y - conn.from.y) / 2;
                svg.append("path")
                    .attr("class", "connection staff-connection")
                    .attr("d", `M ${conn.from.x} ${conn.from.y + 60} L ${conn.from.x} ${midStaffY} L ${conn.to.x} ${midStaffY} L ${conn.to.x} ${conn.to.y - 60}`)
                    .attr("stroke", "#5c542c")
                    .attr("stroke-width", 3)
                    .attr("fill", "none");
            });

            // Create node groups
            const nodes = svg.selectAll(".node")
                .data(orgData)
                .enter()
                .append("g")
                .attr("class", "node")
                .attr("transform", d => `translate(${d.x}, ${d.y})`);

            // Add main rectangles
            nodes.append("rect")
                .attr("x", -100)
                .attr("y", -60)
                .attr("width", 200)
                .attr("height", 120)
                .attr("rx", 8)
                .attr("fill", "#a39372")
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 2);

            // Add profile circles with clipping path for images
            nodes.append("defs")
                .append("clipPath")
                .attr("id", d => `clip-${d.id}`)
                .append("circle")
                .attr("cx", 0)
                .attr("cy", -25)
                .attr("r", 25);

            // Add profile circle backgrounds
            nodes.append("circle")
                .attr("cx", 0)
                .attr("cy", -25)
                .attr("r", 25)
                .attr("fill", "white")
                .attr("stroke", "#5c542c")
                .attr("stroke-width", 3);

            // Add profile images
            nodes.append("image")
                .attr("x", -25)
                .attr("y", -50)
                .attr("width", 50)
                .attr("height", 50)
                .attr("clip-path", d => `url(#clip-${d.id})`)
                .attr("href", d => d.image)
                .on("error", function(event, d) {
                    // If image fails to load, hide it and show initials instead
                    d3.select(this).style("display", "none");
                    d3.select(this.parentNode).select(".initials-text").style("display", "block");
                });

            // Add profile initials as fallback (initially hidden)
            nodes.append("text")
                .attr("class", "initials-text")
                .attr("x", 0)
                .attr("y", -20)
                .attr("text-anchor", "middle")
                .attr("font-family", "Inter, sans-serif")
                .attr("font-size", "14px")
                .attr("font-weight", "bold")
                .attr("fill", "#a39372")
                .style("display", "none") // Hidden by default, shown if image fails
                .text(d => {
                    const names = d.name.split(' ');
                    // Use second name if available, otherwise first
                    const second = names.length > 1 ? names[1] : names[0];
                    const last = names[names.length - 1];
                    return second.charAt(0) + (last ? last.charAt(0) : '');
                });

            // Add names
            nodes.append("text")
                .attr("x", 0)
                .attr("y", 15)
                .attr("text-anchor", "middle")
                .attr("font-family", "Inter, sans-serif")
                .attr("font-size", "12px")
                .attr("font-weight", "bold")
                .attr("fill", "white")
                .each(function(d) {
                    const text = d3.select(this);
                    const words = d.name.split(' ');
                    text.text('');
                    
                    let line = [];
                    let lineNumber = 0;
                    
                    words.forEach(word => {
                        line.push(word);
                        if (line.join(' ').length > 20 || words.indexOf(word) === words.length - 1) {
                            text.append('tspan')
                                .attr('x', 0)
                                .attr('dy', lineNumber === 0 ? 0 : '1.1em')
                                .text(line.join(' '));
                            line = [];
                            lineNumber++;
                        }
                    });
                });

            // Add titles
            nodes.append("text")
                .attr("x", 0)
                .attr("y", 40)
                .attr("text-anchor", "middle")
                .attr("font-family", "Inter, sans-serif")
                .attr("font-size", "10px")
                .attr("fill", "rgba(255,255,255,0.9)")
                .each(function(d) {
                    const text = d3.select(this);
                    const words = d.title.split(' ');
                    text.text('');
                    
                    let line = [];
                    let lineNumber = 0;
                    
                    words.forEach(word => {
                        line.push(word);
                        if (line.join(' ').length > 25 || words.indexOf(word) === words.length - 1) {
                            text.append('tspan')
                                .attr('x', 0)
                                .attr('dy', lineNumber === 0 ? 0 : '1.1em')
                                .text(line.join(' '));
                            line = [];
                            lineNumber++;
                        }
                    });
                });

            // Add hover effects
            nodes
                .on("mouseover", function(event, d) {
                    d3.select(this).select("rect")
                        .transition()
                        .duration(200)
                        .attr("fill", "#5c542c");
                })
                .on("mouseout", function(event, d) {
                    d3.select(this).select("rect")
                        .transition()
                        .duration(200)
                        .attr("fill", "#a39372");
                });
        }

        // Initialize when page loads
        window.addEventListener('DOMContentLoaded', createOrgChart);
        
        // Recreate chart on window resize
        window.addEventListener('resize', function() {
            setTimeout(createOrgChart, 100);
        });
    </script>

    <!-- Custom Styling -->
    <style>
        #orgchart {
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); */
            overflow: hidden;
        }
        
        #orgchart svg {
            display: block;
            margin: 0 auto;
        }
        
        .node {
            cursor: pointer;
        }
        
        .connection {
            pointer-events: none;
        }
        
        .node text {
            pointer-events: none;
            user-select: none;
        }
    </style>
@endsection