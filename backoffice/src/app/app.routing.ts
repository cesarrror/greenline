import { ModuleWithProviders } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { AuthGuard } from "./helpers/auth.guard";


import { IndexComponent } from './components/dashboard/index/index.component';
import { LoginComponent } from './components/login/login.component';
import { ErrorComponent } from './components/error/error.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { SalesComponent } from './components/dashboard/sales/sales.component';
import { DetailsComponent } from './components/dashboard/sales/details/details.component';
import { ProductsComponent } from './components/dashboard/products/products.component';
import { NewProductComponent } from './components/dashboard/products/new-product/new-product.component';
import { ProfileComponent } from './components/dashboard/profile/profile.component';
import { MessagesComponent } from './components/dashboard/messages/messages.component';
import { ServicesComponent } from './components/dashboard/services/services.component';
import { ProspectsComponent } from './components/dashboard/prospects/prospects.component';
import { TicketsComponent } from './components/dashboard/tickets/tickets.component';
import { SchedulesComponent } from './components/dashboard/schedules/schedules.component';

const appRoutes: Routes = [
    {
        path : '',
        component : LoginComponent,
        pathMatch : 'full'
    },
    {
        path : 'dashboard',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : IndexComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    { 
        path : 'sales',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : SalesComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    { 
        path : 'sales/:id',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : DetailsComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'products',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : ProductsComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'products/create',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : NewProductComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'products/:id',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : DetailsComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'user/profile',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : ProfileComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'messages',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : MessagesComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'prospects',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : ProspectsComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'schedules',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : SchedulesComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'services',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : ServicesComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : 'tickets',
        component : DashboardComponent,
        canActivate : [AuthGuard],
        children : [ { path : '', component : TicketsComponent, canActivate : [AuthGuard], outlet : 'admin' }, ]
    },
    {
        path : '**',
        component : ErrorComponent
    }
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<any> = RouterModule.forRoot(appRoutes);
