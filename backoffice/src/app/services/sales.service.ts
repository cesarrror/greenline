import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable, BehaviorSubject } from "rxjs";
import { map } from "rxjs/operators";

import { Sales_Per_User } from "../models/sales.model";

@Injectable({
  providedIn: 'root'
})
export class SalesService {
  private salesPerUserSubject: BehaviorSubject<Sales_Per_User>;
  private salesPerUser: Observable<Sales_Per_User>;
  public url: String;

  constructor(private http: HttpClient) {
    this.salesPerUserSubject = new BehaviorSubject<Sales_Per_User>(JSON.parse(sessionStorage.getItem('page')));
    this.salesPerUser = this.salesPerUserSubject.asObservable();
    this.url = "http://localhost:8000";
  }

  public get Page(): Sales_Per_User{
    return this.salesPerUserSubject.value;
  }

  sales_per_user(page){
    return this.http.get<any>(this.url+"/api/sales/page/"+page)
    .pipe(map(sales => {
      this.salesPerUserSubject.next(sales);
      return sales;
    }));
  }
}
