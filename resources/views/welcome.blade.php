<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>

    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
            background: #0f172a;
            color: white;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        h1 {
            font-size: 60px;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        p {
            font-size: 18px;
            opacity: 0.7;
        }

        .dots {
            position: absolute;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="dots"></div>

<div class="container">
    <h1>Coming Soon</h1>
    <p>We are working on something awesome 🚀</p>
</div>

<script>
    const width = window.innerWidth;
    const height = window.innerHeight;

    const svg = d3.select(".dots")
        .append("svg")
        .attr("width", width)
        .attr("height", height);

    const particles = d3.range(80).map(() => ({
        x: Math.random() * width,
        y: Math.random() * height,
        r: Math.random() * 3 + 1
    }));

    const circles = svg.selectAll("circle")
        .data(particles)
        .enter()
        .append("circle")
        .attr("cx", d => d.x)
        .attr("cy", d => d.y)
        .attr("r", d => d.r)
        .attr("fill", "#38bdf8")
        .attr("opacity", 0.7);

    function animate() {
        circles
            .transition()
            .duration(3000)
            .attr("cx", d => {
                d.x += (Math.random() - 0.5) * 50;
                return d.x;
            })
            .attr("cy", d => {
                d.y += (Math.random() - 0.5) * 50;
                return d.y;
            })
            .on("end", animate);
    }

    animate();
</script>

</body>
</html>