browserChart();

function browserChart() {
    var strucData = [];
    data.forEach(function (ele) {
        var t = ele.browserName.toLowerCase();
        if (typeof strucData[t] == 'undefined') {
            strucData[t] = 1;
        } else {
            strucData[t] += 1;
        }
    });
    for (const key in strucData) {
        countUp("." + key, strucData[key]);
    }
}

function countUp(elem, countTo) {
    const animationDuration = 800;
    const frameDuration = 1000 / 60;
    const totalFrames = Math.round(animationDuration / frameDuration);
    const easeOutQuad = t => t * (2 - t);
    const animateCountUp = el => {
        let frame = 0;
        const counter = setInterval(() => {
            frame++;
            const progress = easeOutQuad(frame / totalFrames);
            const currentCount = Math.round(countTo * progress);
            if (parseInt(el.innerHTML, 10) !== currentCount) {
                el.innerHTML = currentCount;
            }
            if (frame === totalFrames) {
                clearInterval(counter);
            }
        }, frameDuration);
    };
    const countupEls = document.querySelectorAll(elem);
    countupEls.forEach(animateCountUp);
}

function roundToNearestHour(date) {
    date.setMinutes(date.getMinutes() + 30);
    date.setMinutes(0, 0, 0);

    return date;
}

visitorChart();

function visitorChart() {
    var strucData = [];
    var finalData = [];

    data.forEach(function (ele) {
        var t = roundToNearestHour(new Date(ele.timeOpened));
        if (typeof strucData[t] == 'undefined') {
            strucData[t] = 1;
        } else {
            strucData[t] += 1;
        }
    });

    for (const key in strucData) {
        finalData.push([key, strucData[key]]);
    }
    var options = {
        series: [{
            name: "Aufrufe",
            data: finalData
        }],
        chart: {
            height: 400,
            type: 'line',
            zoom: {
                enabled: true
            },
            toolbar: {
                show: true,
            }
        },
        stroke: {
            curve: 'stepline',
        },
        xaxis: {
            type: 'datetime'
        },
        dataLabels: {
            enabled: false
        },
        title: {
            text: 'Seitenaufrufe',
            align: 'left',
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            },
        },
        axisBorder: {
            show: true,
            color: 'white',
            height: 1,
            width: '100%',
            offsetX: 0,
            offsetY: 0
        },
        markers: {
            hover: {
                sizeOffset: 4
            }
        },
        tooltip: {
            theme: "dark",
        }
    };

    var visitorChart = new ApexCharts(document.querySelector("#visitorChart"), options);
    visitorChart.render();
}

var sparkHeight = 80;

onlineVisitorChart();

function onlineVisitorChart() {
    var options1 = {
        series: [{
            data: [0, 1, 0, 3, 1, 0, 0, 0, 2, 3, 2]
        }],
        chart: {
            type: 'line',
            height: sparkHeight,
            sparkline: {
                enabled: true
            }
        },
        grid: {
            padding: {
                top: 15,
                bottom: 15,
            }
        },
        tooltip: {
            fixed: {
                enabled: false
            },
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return ''
                    }
                }
            },
            marker: {
                show: false
            },
            theme: "dark",
        },
    };

    var chart = new ApexCharts(document.querySelector("#onlineVisitorChart"), options1);
    chart.render();
}

countryChart();

function countryChart() {
    var strucData = [];
    var finalData = [];
    var labels = [];

    data.forEach(function (ele) {
        var location = JSON.parse(ele.location);
        if (location != null && location != "") {
            for (const key in location) {
                if (location.country_name != null && location.country_name != "" && location.country_name != null && location.country_name != "") {
                    var flag = location.location.country_flag_emoji_unicode.replaceAll("U+", "&#x").replace(" ", ";")+";";
                    var c = location.country_name+" "+flag;
                    if (typeof strucData[c] == 'undefined') {
                        strucData[c] = 1;
                    } else {
                        strucData[c] += 1;
                    }
                }
            };
        }
    });

    for (const key in strucData) {
        finalData.push(strucData[key]);
        labels.push(key);
    }

    var options = {
        series: finalData,
        chart: {
            type: 'donut',
            height: 400,
            width: "100%"
        },
        labels: labels,
        title: {
            text: 'Besucher Herkunft',
            align: 'left',
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            },
        },
        legend: {
            show: false,
        },
        // responsive: [{
        //     breakpoint: 480,
        //     options: {
        //         chart: {
        //             width: 200
        //         },
        //         legend: {
        //             position: 'bottom'
        //         }
        //     }
        // }]
    };

    var chart = new ApexCharts(document.querySelector("#countryChart"), options);
    chart.render();
}

linkChart();

function linkChart() {
    var strucData = [];
    var finalData = [];

    data.forEach(function (ele) {
        var linkClickhistory = JSON.parse(ele.linkClickhistory);
        if (linkClickhistory != null && linkClickhistory != "") {
            linkClickhistory.forEach(function (link) {
                if (link != null && link != "") {
                    link = cleanLink(link);
                    if (typeof strucData[link] == 'undefined') {
                        strucData[link] = 1;
                    } else {
                        strucData[link] += 1;
                    }
                }
            });
        }
    });

    for (const key in strucData) {
        finalData.push({ x: key, y: strucData[key] });
    }

    var options = {
        series: [{
            name: "Aufrufe",
            data: finalData.sort((a, b) => b.y - a.y)
        }],
        chart: {
            type: 'bar',
            height: 350,
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        title: {
            text: 'Beliebteste Links',
            align: 'left',
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            },
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            theme: "dark",
        },
    };

    var chart = new ApexCharts(document.querySelector("#linkChart"), options);
    chart.render();
}

function getWeekday(day) {
    switch (day) {
        case 0:
            return "Sonntag";
        case 1:
            return "Montag";
        case 2:
            return "Dienstag";
        case 3:
            return "Mittwoch";
        case 4:
            return "Donnerstag";
        case 5:
            return "Freitag";
        case 6:
            return "Samstag";
    }
}

function diff_minutes(dt2, dt1) {
    var diff = (dt2.getTime() - dt1.getTime()) / 1000;
    diff /= 60;
    return Math.abs(diff);
}

totalTimeChart();

function totalTimeChart() {
    var strucData = [];
    var finalData = [];

    data.forEach(function (ele) {
        var today = new Date();
        var t = new Date(ele.timeOpened);
        today.setDate(today.getDate() + 1);
        for (let index = 0; index < 7; index++) {
            today.setDate(today.getDate() - 1);
            var key = getWeekday(today.getDay());
            if (index == 0) {
                key = "Heute";
            }
            if (typeof strucData[key] == 'undefined') {
                strucData[key] = 0
            }
            if (today.toDateString() === t.toDateString()) {
                strucData[key] += diff_minutes(t, new Date(ele.timeLeft));
            }
        }
    });

    for (const key in strucData) {
        finalData.push({ x: key, y: Math.round(strucData[key]) });
    }

    var options = {
        series: [{
            name: 'Besuchte Zeit in min',
            data: finalData.reverse()
        }],
        title: {
            text: 'Tägliche Aufrufzeit der letzten 7 Tage in min',
            align: 'left',
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            },
        },
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm',
            },
            theme: "dark",
        },
    };

    var chart = new ApexCharts(document.querySelector("#totalTimeChart"), options);
    chart.render();
}

mobileChart();

function mobileChart() {
    var d = 0;
    var m = 0;
    data.forEach(function (ele) {
        var t = ele.isMobile;
        if (t === "0") {
            d += 1;
        } else {
            m += 1;
        }
    });

    var options = {
        series: [{
            name: 'Mobile',
            data: [m]
        },
        {
            name: 'Desktop',
            data: [d]
        }],
        title: {
            text: 'Geräte Aufteilung',
            align: 'left',
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: 'white'
            },
        },
        chart: {
            type: 'bar',
            height: 350,
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ["Mobile", "Desktop"],
            labels: {
                show: false,
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: "dark",
        }
    };

    var chart = new ApexCharts(document.querySelector("#mobileChart"), options);
    chart.render();
}