import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { addFlashMessage } from '../actions/flashMessages';


// This function create a HOC (High-Order Component)
// This is for view protecting across the requireAuth function in the routes
export default function(ComposedComponent){
    // This is the High Component
    class Authenticate extends React.Component{

        // Chech the required props before the component get mount
        componentWillMount(){
            if(!this.props.isAuthenticated){
                this.props.addFlashMessage({
                    type: 'error',
                    text: 'Debes loguearte para acceder a esta sección'
                });
                this.context.router.push('/login');
            }
        }
        // When the user use the logout() dispatch this update
        componentWillUpdate(nextProps){
            if(!nextProps.isAuthenticated){
                this.context.router.push('/');
            }
        }

        render(){
            //Here we build the child component who will return the protected view
            return(
                <ComposedComponent {...this.props} />
            );
        }
    }

    // Add the known props that we use for the high component
    Authenticate.PropTypes = {
        isAuthenticated: PropTypes.bool.isRequired,
        addFlashMessage: PropTypes.func.isRequired
    };

    Authenticate.contextTypes = {
        router: PropTypes.object.isRequired
    };

    function mapStateToProps(state){
        return {
            isAuthenticated: state.auth.isAuthenticated
        }
    }

    // Connect the High component to the global app
    return connect(mapStateToProps, { addFlashMessage })(Authenticate);
}