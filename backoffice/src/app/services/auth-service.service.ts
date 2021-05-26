import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable, BehaviorSubject } from "rxjs";
import { map } from "rxjs/operators";
import { environment } from "../../environments/environment";

import { Authenticated, UserData } from "../models/user.model";

@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {
  private currentUserSubject: BehaviorSubject<Authenticated>;
  private UserSubject : BehaviorSubject<UserData>;
  public currentUser: Observable<Authenticated>;
  public User : Observable<UserData>;
  public url: String;

  constructor(private http: HttpClient) {
    this.currentUserSubject = new BehaviorSubject<Authenticated>(JSON.parse(localStorage.getItem('currentUser')));
    this.UserSubject = new BehaviorSubject<UserData>(JSON.parse(localStorage.getItem('userData')));
    this.currentUser = this.currentUserSubject.asObservable();
    this.User = this.UserSubject.asObservable();
    this.url = environment.APIBase
  }

  public get currentUserValue(): Authenticated {
    return this.currentUserSubject.value;
  }
  public get UserDataValue(): UserData {
    return this.UserSubject.value;
  }

  login(email, password, remember_me){
    return this.http.post<any>(this.url+"api/auth/login", {email, password, remember_me})
      .pipe(map(user => {
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.currentUserSubject.next(user);
        return user;
      }));
  }

  logout(){    
    return this.http.get<any>(this.url+"api/logout");
  }

  userAuthenticated(){
    return this.http.get<any>(this.url+"api/users/info")
      .pipe(map(user => {
        localStorage.setItem('userData', JSON.stringify(user));
        this.UserSubject.next(user);
        return user;
      }));
  }
}
