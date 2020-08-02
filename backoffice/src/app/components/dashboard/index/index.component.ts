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
    // this.headers = ["Sale Id","User","Ticket","Subtotal","Taxes","Actions"];
    this.headers = ["Sale Id","User","Ticket","Subtotal","Taxes"];
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
        // this.data_sales = [];
        // var reqComplete = new Promise(resolve => {
        //   for(var i = 0; i < data.length; i++){
        //     this.data_sales[i] = [];
        //     this.data_sales[i][0] = data[i].id;
        //     this.data_sales[i][1] = data[i].user_id;
        //     this.data_sales[i][2] = data[i].ticket;
        //     this.data_sales[i][3] = data[i].subtotal;
        //     this.data_sales[i][4] = data[i].taxes;
        //   }
        //   resolve(this.data_sales);
        // });


        // if(reqComplete){
        //   this.dataTableData = {
        //     pagination: {
        //       pagination : true,
        //       pages : this.limitPage || 1,
        //       paginator : 'circular' // Circular, Classical
        //     },
        //     data : this.data_sales,
        //     headers : this.headers,
        //     buttons : {
        //       init: true,
        //       list : ['details','edit','remove'], // Details, Edit, Remove, Show, Download, Print
        //       url : environment.Dashboard,
        //       position: 'end' // Start, End
        //     },
        //     sort: true
        //   };
        // }
        
      }, error => {
        console.error(error);
      })
  }

}
