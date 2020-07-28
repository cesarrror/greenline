import { Component, OnInit } from '@angular/core';
import { Chart } from "angular-highcharts";
// import {  } from "ng-uikit-pro-standard";

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {
  chart: Chart;
  dataVector = [153, 29, 13, 120, 112, 162];

  constructor() { }

  ngOnInit(){
    this.init();
  }

  init() {
    let chart = new Chart({
      chart: {
        type: 'column',
        height : '300px'
      },
      title: {
        text: 'Sales Per Month'
      },
      credits: {
        enabled: false
      },
      colors : [
        '#FFC837',
        '#FFC837'
      ],
      series: [{
        name: 'Line 1',
        data: this.dataVector
      }]
    });
    this.chart = chart;

    chart.ref$.subscribe(console.log);
  }

}
