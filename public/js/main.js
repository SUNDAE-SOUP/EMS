window.addEventListener("load", function() {
    const getChartOptions = () => {
        // Get the table element by its ID
        const dataTable = document.getElementById("data-table");

        // Get all the <td> elements within the table
        const tdElements = dataTable.querySelectorAll("td");

        // Initialize an empty array to store the series values
        const seriesData = [];

        // Loop through each <td> element and extract its value
        tdElements.forEach((tdElement) => {
            // Convert the text content of the <td> element to a float and push it to the series array
            seriesData.push(parseFloat(tdElement.textContent));
        });

        // Get all the <th> elements within the table header
        const thElements = dataTable.querySelectorAll("th");

        // Initialize an empty array to store the labels
        const labels = [];

        // Loop through each <th> element and extract its text content
        thElements.forEach((thElement) => {
            if (thElement.textContent !== "Total") { 
            labels.push(thElement.textContent);
            }
        });


        // Generate an array of random colors excluding white
        const generateRandomColors = (count) => {
            const colors = [];
            for (let i = 0; i < count; i++) {
                let color;
                do {
                    color = "#" + Math.floor(Math.random() * 16777215).toString(16);
                } while (isInvalidColor(color) || isTooCloseToWhite(color));
                colors.push(color);
            }
            return colors;
        };
        
        const isInvalidColor = (color) => {
            const hex = color.replace("#", "");
            return hex.length !== 6 || !/^[0-9A-Fa-f]+$/.test(hex);
        };
        
        const isTooCloseToWhite = (color) => {
            const hex = color.replace("#", "");
            const r = parseInt(hex.substring(0, 2), 16);
            const g = parseInt(hex.substring(2, 4), 16);
            const b = parseInt(hex.substring(4, 6), 16);
            const brightness = (r + g + b) / 3;
            const threshold = 200;
            return brightness > threshold;
        };
        
        const randomColors = generateRandomColors(seriesData.length);
        
        

        return {
          series: seriesData,
          colors: randomColors,
          chart: {
            height: 420,
            width: "100%",
            type: "pie",
          },
          stroke: {
            colors: ["white"],
            lineCap: "",
          },
          plotOptions: {
            pie: {
              labels: {
                show: true,
              },
              size: "100%",
              dataLabels: {
                offset: -25
              }
            },
          },
          labels: labels,
          dataLabels: {
            enabled: true,
            style: {
              fontFamily: "Inter, sans-serif",
            },
          },
          legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
          },
          yaxis: {
            labels: {
              formatter: function (value) {
                return value
              },
            },
          },
          xaxis: {
            labels: {
              formatter: function (value) {
                return value
              },
            },
            axisTicks: {
              show: false,
            },
            axisBorder: {
              show: false,
            },
          },
        }
    }

    if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
    }
    if (document.getElementById("pie-chart2") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart2"), getChartOptions());
    chart.render();
    }
});

document.addEventListener('DOMContentLoaded', function() {
  var editButtons = document.querySelectorAll('[data-modal-toggle="roleUpdateModal"]');
  var modalNameInput = document.getElementById('modalNameInput');
  var modalDescriptionInput = document.getElementById('modalDescriptionInput');
  var modalCreatedAtInput = document.getElementById('modalCreatedAtInput');
  var modalDataIdInput = document.getElementById('modalDataIdInput');
  

  editButtons.forEach(function(button) {
      button.addEventListener('click', function() {
          var row = button.closest('tr');
          modalNameInput.value = row.getAttribute('data-name');
          modalDescriptionInput.value = row.getAttribute('data-description');
          modalDataIdInput.value = row.getAttribute('data-id')
          // Format the date as yyyy-mm-dd (required by input type="date")
          var rawDate = new Date(row.getAttribute('data-created-at'));
          var formattedDate = rawDate.toISOString().split('T')[0];
          modalCreatedAtInput.value = formattedDate;
      });
  });
});