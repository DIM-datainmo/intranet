import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/article/';

export default [
  <Route path="/articles/create" component={Create} exact key="create" />,
  <Route path="/articles/edit/:id" component={Update} exact key="update" />,
  <Route path="/articles/show/:id" component={Show} exact key="show" />,
  <Route path="/articles/" component={List} exact strict key="list" />,
  <Route path="/articles/:page" component={List} exact strict key="page" />
];
