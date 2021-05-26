import { Component, OnInit } from '@angular/core';
import { SalesService } from "../../../../services/sales.service";
import { environment } from "../../../../../environments/environment";
import { ActivatedRoute } from "@angular/router";
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-details',
  templateUrl: './details.component.html',
  styleUrls: ['./details.component.css']
})
export class DetailsComponent implements OnInit {
  public isLoadingSale: boolean = true;
  public isLoadingTicket: boolean = true;
  public id: Number;
  public sale: any;
  public subtotal: any = 0; 

  constructor(
    private _salesService: SalesService,
    private _route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.id = Number(this._route.snapshot.paramMap.get('id'));
    this._salesService.sale_per_id(this.id)
      .pipe()
      .subscribe(data => {
        this.isLoadingSale = false;
        this.isLoadingTicket = false;
        this.sale = data;

        let tickets;
        tickets = this.sale.tickets;
        console.log(tickets)

        tickets.forEach(element => {
          console.log(element.price)
          this.subtotal += element.price; 
        });

        this.subtotal = this.subtotal.toFixed(2);
        console.log("subtotal", this.subtotal)
      }, error => {
        console.error(error);
      });
  }

}
