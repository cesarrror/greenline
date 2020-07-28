import { ModuleWithProviders } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { AuthGuard } from "./helpers/auth.guard";


import { IndexComponent } from './components/dashboard/index/index.component';
import { LoginComponent } from './components/login/login.component';
import { ErrorComponent } from './components/error/error.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

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
        children : [
            {
                path : '',
                component : IndexComponent,
                canActivate : [AuthGuard],
                outlet : 'admin'
            }
        ]
    },
    {
        path : '**',
        component : ErrorComponent
    }
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders<any> = RouterModule.forRoot(appRoutes);
