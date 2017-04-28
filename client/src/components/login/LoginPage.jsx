import React from 'react';
import LoginForm from './LoginForm';

import './login.css';

class LoginPage extends React.Component{

    render(){
        return(
            <div className="login-container">
                <div className="background">&nbsp;</div>
                <LoginForm/>
            </div>
        );
    }
}

export default LoginPage;