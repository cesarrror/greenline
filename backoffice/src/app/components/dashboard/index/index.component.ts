import { Component, OnInit } from '@angular/core';
import { Chart } from "angular-highcharts";
import { SalesService } from "../../../services/sales.service";
import { environment } from "../../../../environments/environment";

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {
  chart: Chart;
  dataVector = [153, 29, 13, 120, 112, 162];
  data_sales: Array<any>;
  headers: Array<any>;
  public dataTableData: Object;
  limitPage: 1;

  public page = sessionStorage.getItem('page') || 1;

  constructor(private salesService: SalesService) { }

  ngOnInit(){
    this.init();
    this.loadSales();
    this.headers = ["Sale Id","User","Ticket","Subtotal","Taxes","Actions"];
    // this.headers = ["Sale Id","User","Ticket","Subtotal","Taxes"];
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
        '#ff8008',
        '#FFC837'
      ],
      series: [{
        type: 'column',
        name: 'Line 1',
        data: this.dataVector
      }]
    });
    this.chart = chart;

    chart.ref$.subscribe();
  }

  loadSales(){
    this.salesService.sales_per_user(this.page)
      .pipe()
      .subscribe(data => {
        this.data_sales = data;        
      }, error => {
        console.error(error);
      })
  }

}
