import { Component, OnInit, Input, OnChanges, SimpleChange, SimpleChanges } from '@angular/core';
import { async } from 'rxjs/internal/scheduler/async';
import { delay } from 'rxjs/operators';

@Component({
  selector: 'kraken-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.css']
})
export class TableComponent implements OnInit {

  constructor() { }

  @Input() table: any;

  public data: Array<any> = [];
  public headers: Array<any>;
  public pagination: boolean;
  public dataError: boolean;
  public actionKey: Number;
  public sortable: boolean = false;

  ngOnInit(): void {
    console.log(this.table);
  }

  ngOnChanges(changes: SimpleChanges){
    this.table = changes.table.currentValue;
    console.log(this.table)

    if(this.table !== undefined){

      if(this.table.sort) this.sortable = this.table.sort;

      if(this.table.data){
        this.data = this.table.data;
      }else{
        this.dataError = true;
      }
  
      if(this.table.headers){
        this.headers = this.table.headers;
      }

      if(this.table.buttons){
        if(this.table.buttons.position == 'start'){
          this.headers.unshift('Actions');          
          for(var i in this.data){
            this.data[i].unshift('');
          }
          this.actionKey = 0;

          (async() => {
            await this.delay(1500);
            this.addButtons(this.table.buttons.position);
          })();
        }else{
          this.headers.push('Actions'); 
          
          this.actionKey = this.headers.length - 1;      
          for(var i in this.data){
            this.data[i].push('');
          }

          (async() => {
            await this.delay(1500);
            this.addButtons(this.table.buttons.position);
          })();
        }
      }

    }    
  }

  delay(ms:number) {
    return new Promise( resolve => setTimeout(resolve,ms) );
  }

  addButtons(position: String){
    var tbody = document.getElementById('kraken-tbody');
    var td: any = '';

    if(position === 'start'){
      td = tbody.querySelectorAll('tr > td:first-child');
    }else{
      td = tbody.querySelectorAll('tr > td:last-child');
    }
  }

  SortElement($event){

    // $event.target
    if($event.target.classList.contains('fa-sort')){
      $event.target.classList.remove('fa-sort')
      $event.target.classList.add('fa-caret-up')
    }else if($event.target.classList.contains('fa-caret-up')){
      $event.target.classList.remove('fa-caret-up')
      $event.target.classList.add('fa-caret-down')
    }else if($event.target.classList.contains('fa-caret-down')){
      $event.target.classList.remove('fa-caret-down')
      $event.target.classList.add('fa-sort')
    }

  }

}


// <!-- <kraken-table [table]="dataTableData"></kraken-table> -->

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


  // this.dataTableData = {
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