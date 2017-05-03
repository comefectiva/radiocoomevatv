import React from 'react';
import { connect } from 'react-redux';
import { logout } from '../../actions/authActions';
import PropTypes from 'prop-types';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import AppBar from 'material-ui/AppBar';
import Drawer from 'material-ui/Drawer';
import Subheader from 'material-ui/Subheader';
import {Toolbar, ToolbarGroup} from 'material-ui/Toolbar';
import Avatar from 'material-ui/Avatar';
import {white} from 'material-ui/styles/colors';
import {
    SocialNotificationsNone
} from 'material-ui/svg-icons';
import IconButton from 'material-ui/IconButton';


import './style.css';
import MenuItem from "material-ui/MenuItem";
import IconMenu from "material-ui/IconMenu";

//This will be our Main Component
class App extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            drawerOpen: false
        };
        this.styles = {
            appBar: {
                backgroundColor: 'rgba(0, 0, 0, 0.84)',
                height: 50
            },
            toolbar: {
                backgroundColor: 'rgba(0, 0, 0, 0.84)',
                backgroundImage: require('../../images/page-header.png'),
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

    handleDrawerToggle = () => this.setState({drawerOpen: !this.state.drawerOpen});

    render(){
        let isAuth = this.props.isAuthenticated;
        return(
            <MuiThemeProvider>
                <div>
                    {isAuth ? (
                        <div>
                            <AppBar
                                title="Panel de Administración"
                                style={this.styles.appBar}
                                onLeftIconButtonTouchTap={this.handleDrawerToggle.bind(this)}
                            />
                            <Drawer
                                open={this.state.drawerOpen}
                                docked={false}
                                onRequestChange={(open) => this.setState({drawerOpen: open})}
                            >
                                <AppBar
                                    title="Menú"
                                    style={this.styles.appBar}
                                    onLeftIconButtonTouchTap={this.handleDrawerToggle.bind(this)}
                                />
                                <Subheader>Opciones de Video</Subheader>
                                <MenuItem href="/admin/videos">Lista de Videos</MenuItem>
                                <MenuItem href="/admin/video/new">Crear Video</MenuItem>
                                <Subheader>Opciones de Bases de datos</Subheader>
                                <MenuItem href="/admin/db">Lista de bases de datos</MenuItem>
                                <MenuItem href="/admin/db/new">Crear Base de datos</MenuItem>
                            </Drawer>
                        </div>
                    ):(<div></div>)}
                    <Toolbar style={this.styles.toolbar}>
                        <ToolbarGroup firstChild={true} style={this.styles.toolbar.logo}>
                            <img src={require('../../images/logo.png')} alt="Logo Aulas Amigas"/>
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
                                        <IconButton touch={true}>
                                            <Avatar
                                                src="http://www.material-ui.com/images/uxceo-128.jpg"
                                                size={30}
                                            />
                                        </IconButton>
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