import React from 'react';
import { connect } from 'react-redux';
import { logout } from '../actions/authActions';
import PropTypes from 'prop-types';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import {Toolbar, ToolbarGroup} from 'material-ui/Toolbar';
import Avatar from 'material-ui/Avatar';
import {white} from 'material-ui/styles/colors';
import {
    SocialNotificationsNone
} from 'material-ui/svg-icons';


import './style.css';
import MenuItem from "material-ui/MenuItem";
import IconMenu from "material-ui/IconMenu";

//This will be our Main Component
class App extends React.Component{

    constructor(props){
        super(props);
        this.styles = {
            toolbar: {
                backgroundColor: '#faba03',
                backgroundImage: require('../images/page-header.png'),
                height: 84,
                logo: {
                    marginLeft: 95
                },
                profile: {
                    marginRight: 120
                }
            },
            icons: {
                width: 30,
                height: 30
            }
        }
    }

    logout(){
        this.props.logout();
    }

    render(){
        let isAuth = this.props.isAuthenticated;
        return(
            <MuiThemeProvider>
                <div>
                    <Toolbar style={this.styles.toolbar}>
                        <ToolbarGroup firstChild={true} style={this.styles.toolbar.logo}>
                            <img src={require('../images/logo.png')} alt="Logo Aulas Amigas"/>
                        </ToolbarGroup>
                        {isAuth ? (
                            <ToolbarGroup style={this.styles.toolbar.profile}>
                                <SocialNotificationsNone
                                color={white}
                                style={this.styles.icons}
                                />
                                <div style={ {margin: '0 10px'} }>&nbsp;</div>
                                <IconMenu
                                    iconButtonElement={
                                        <Avatar
                                            src="http://www.material-ui.com/images/uxceo-128.jpg"
                                            size={30}
                                        />
                                    }
                                    onItemTouchTap={this.logout.bind(this)}
                                >
                                    <MenuItem primaryText="Cerrar Sesión" />
                                </IconMenu>
                            </ToolbarGroup>
                        ) : (<div></div>)}
                    </Toolbar>
                    {this.props.children}
                </div>
            </MuiThemeProvider>
        );
    }
}

// We need to check the auth in this Component for show or not the user panel
App.PropTypes = {
    isAuthenticated: PropTypes.bool.isRequired,
    logout: PropTypes.func.isRequired
};

// With this function we map the global state of the app to the local state adding the property isAuthenticated
function mapStateToProps(state) {
    return {
        isAuthenticated: state.auth.isAuthenticated
    }
}
//Connect this Component with the app provider who have the global state.
export default connect(mapStateToProps, { logout })(App);