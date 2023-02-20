import React from 'react';
import ReactDOM from 'react-dom';
import { RouterProvider } from 'react-router-dom';
import routes from '../routers/routes';


if (document.getElementById('root')) {
    ReactDOM.render(
    <RouterProvider router={routes} />, 
    document.getElementById('root'));
}

