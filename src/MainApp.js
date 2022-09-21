import {BrowserRouter, Routes, Route} from 'react-router-dom';
import { useState, useEffect } from 'react';
import $ from 'jquery';

import RoutingLayout from './pages/RoutingLayout';
import Home from './pages/Home';
import Login from './pages/Login';
import Logout from './pages/Logout';
import Register from './pages/Register';
import Main from './pages/Main';
import PostDetail from './pages/PostDetail';
import AddPost from './pages/AddPost';
import PostDashboard from './pages/PostDashboard';
import EditPost from './pages/EditPost';
import EditUser from './pages/EditUser';
import NoPage from './pages/NoPage';

export default function MainApp(){
  return(
    <BrowserRouter>
      <Routes>
        <Route index element={<Home/>}/>
        <Route path='/' element={<RoutingLayout/>}>
          <Route path='login' element={<Login/>}/>
          <Route path='logout' element={<Logout/>}/>
          <Route path='register' element={<Register/>}/>
          <Route path='main' element={<Main/>}/>
          <Route path='postdetail' element={<PostDetail/>}/>
          <Route path='addpost' element={<AddPost/>}/>
          <Route path='dashboard' element={<PostDashboard/>}/>
          <Route path='editpost' element={<EditPost/>}/>
          <Route path='edituser' element={<EditUser/>}/>
        </Route>
        <Route path='*' element={<NoPage/>}/>
      </Routes>
    </BrowserRouter>
  )
}