import Products from './components/Products';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Products
    }, {
        name: 'category',
        path: '/:id',
        component: Products
    },
];
