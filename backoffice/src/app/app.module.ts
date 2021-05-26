import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from "@angular/forms";
import { routing, appRoutingProviders } from "./app.routing";
import { HttpClientModule, HTTP_INTERCEPTORS } from "@angular/common/http";
import { TooltipModule } from "ngx-bootstrap/tooltip";
import { ChartModule } from "angular-highcharts";

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { ErrorComponent } from './components/error/error.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { AlertComponent } from './components/alert/alert.component';
import { NavbarComponent } from './components/dashboard/navbar/navbar.component';
import { ErrorInterceptor } from "./helpers/error.interceptor";
import { JwtInterceptor } from "./helpers/jwt.interceptors";
import { IndexComponent } from './components/dashboard/index/index.component';
import { TableComponent } from './components/dashboard/table/table.component';
import { SalesComponent } from './components/dashboard/sales/sales.component';
import { DetailsComponent } from './components/dashboard/sales/details/details.component';
import { ProductsComponent } from './components/dashboard/products/products.component';
import { UsersComponent } from './components/dashboard/users/users.component';
import { ServicesComponent } from './components/dashboard/services/services.component';
import { TicketsComponent } from './components/dashboard/tickets/tickets.component';
import { ProspectsComponent } from './components/dashboard/prospects/prospects.component';
import { SchedulesComponent } from './components/dashboard/schedules/schedules.component';
import { MessagesComponent } from './components/dashboard/messages/messages.component';
import { ProfileComponent } from './components/dashboard/profile/profile.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ErrorComponent,
    DashboardComponent,
    AlertComponent,
    NavbarComponent,
    IndexComponent,
    TableComponent,
    SalesComponent,
    DetailsComponent,
    ProductsComponent,
    UsersComponent,
    ServicesComponent,
    TicketsComponent,
    ProspectsComponent,
    SchedulesComponent,
    MessagesComponent,
    ProfileComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    routing,
    HttpClientModule,
    TooltipModule.forRoot(),
    ChartModule
  ],
  providers: [
    appRoutingProviders,
    { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
