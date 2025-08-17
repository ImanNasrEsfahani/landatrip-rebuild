import React from 'react';
import ReactApexChart from 'react-apexcharts';

const data = {
    options: {
        chart: {
            type: 'bar',
            stacked: true,
            toolbar: {
                show: false,
            },

        },
        plotOptions: {
            bar: {
                borderRadius: 15,
                horizontal: true,
            },

        },
        xaxis: {
            categories: ['Category 1'],
            labels: {
                show: false,
            },
            show: false,
        },
        yaxis: {
            show: false,
        },
        legend: {
            show: false, // Remove legend
        },
        grid: {
            show: false, // Remove grid borders
        },
    },
    series: [
        {
            name: 'Series 1',
            data: [30],
        },
        {
            name: 'Series 2',
            data: [20],
        },
        {
            name: 'Series 3',
            data: [50],
        },
    ],
};
const HorizontalStackedBarChart = () => {
    return (
        <div id="chart">
            <ReactApexChart
                options={data.options}
                series={data.series}
                type="bar"
                height={90}
                width={470}
            />
        </div>
    );
};

export default HorizontalStackedBarChart;
