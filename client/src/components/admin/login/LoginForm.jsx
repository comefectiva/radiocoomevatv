import React from 'react';
import PropTypes from 'prop-types';
import TextField from 'material-ui/TextField';
import RaisedButton from 'material-ui/RaisedButton';
import { connect } from 'react-redux';
import { login } from '../../../actions/authActions';

import Validator from 'validator';
import isEmpty from 'lodash/isEmpty';

// Needed for onTouchTap
import injectTapEventPlugin from 'react-tap-event-plugin';
injectTapEventPlugin();

function validateInput(data){
    let errors = {};

    if(Validator.isEmpty(data.mail)){
        errors.mail = 'Este campo es obligatorio'
    }

    if(Validator.isEmpty(data.password)){
        errors.password = 'Este campo es obligatorio'
    }

    return {
        errors,
        isValid: isEmpty(errors)
    };
}

class LoginForm extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            mail: '',
            password: '',
            errors: {},
            errorLogin: null,
            isLoading: false
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    onChange(event){
        this.setState({ [event.target.name]: event.target.value })
    }

    isValid(){
        const { errors, isValid } = validateInput(this.state);

        if(!isValid){
            this.setState({ errors });
        }

        return isValid;
    }

    onSubmit(event){
        event.preventDefault();
        if(this.isValid()){
            this.setState({
                errors: {},
                isLoading: true
            });
            this.props.login(this.state).then(
                (res) => this.context.router.push('/admin/video'),
                (err) => this.setState({ errorLogin: true, isLoading: false })
            );
        }
    }

    render(){
        const { errors, errorLogin, mail, password } = this.state;
        return(
            <form onSubmit={this.onSubmit}>
                <hgroup>
                    <h2>Ingresar</h2>
                </hgroup>
                {errorLogin ? (
                    <div>
                        Información de ingreso inválida.
                    </div>
                ): (<div></div>)}
                <TextField
                    name="mail"
                    floatingLabelText="Email"
                    value={mail}
                    errorText={errors.mail}
                    onChange={this.onChange}
                />
                <TextField
                    name="password"
                    floatingLabelText="Contraseña"
                    value={password}
                    errorText={errors.password}
                    onChange={this.onChange}
                    type="password"
                /><br/>
                <RaisedButton
                    label="Ingresar"
                    type="submit"
                />
            </form>
        );
    }
}

// Pass login as a prop for accessing the action across it
LoginForm.PropTypes = {
    login: PropTypes.func.isRequired
};

// Give to this component the power to redirect the route
LoginForm.contextTypes = {
    router: PropTypes.object.isRequired
};

// Connect the component to the global app for execute an action
export default connect(null, { login })(LoginForm);