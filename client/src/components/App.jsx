import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

//This will be our Main Component
class App extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            drawerOpen: false
        };
    }

    logout(){
        this.props.logout();
    }

    handleDrawerToggle = () => this.setState({drawerOpen: !this.state.drawerOpen});

    render(){
        let layout = true;
        return(
            <MuiThemeProvider>
                <div>
                    <header className="{{headerClass}}">
                        <div className={layout ? 'container-fluid' : 'container-fluid company'}>
                            <img src={require("./images/headerlogo.png")} alt="" />

                            <nav className="main-menu">
                                <a href="colaboradores">Colaboradores</a>
                                <a href="programastare">Programas</a>
                                <a href="podcasts">Podcasts</a>
                                <a href="home">Inicio</a>
                                <img
                                    id="yellow-bar"
                                    src={require("./images/menuActive.jpg")}
                                    alt=""
                                    style={
                                        {
                                            display: 'none',
                                            visibility: 'hidden',
                                            //left: {{getItemPosition.left-0}}px,
                                            //width: {{imageSize}}px;height:7px
                                        }
                                    } />
                            </nav>
                        </div>
                    </header>
                    <div className="container-fluid">
                        <div className="main">
                            {this.props.children}
                        </div>
                    </div>

                    <footer className="row">
                        <div className="container-fluid">

                            <div className="col-md-12">
                                <div className="footer-item col-md-3">
                                    <h4>Nuestro Equipo</h4>
                                    <p>Radio Coomeva es una propuesta fresca y variada de radio en Internet que no está sólo pensada para las personas asociadas o relacionadas con Coomeva, sino también para quienes buscan la compañía
                                        de excelente música y quieren dejarse sorprender con interesantes contenidos de audio entregados en podcast.
                                    </p>
                                </div>
                                <div className="footer-item col-md-3">
                                    <h4>Empresas Coomeva</h4>
                                    <p>Coomeva te facilita la vida, por eso te invitamos a que conozcas todos nuestros servicios:</p>
                                    <ul className="">
                                        <li><a href="#">Coomeva EPS</a></li>
                                        <li><a href="#">Bancoomeva</a></li>
                                        <li><a href="#">Coomeva Solidaridad y Seguros</a></li>
                                        <li><a href="#">Coomeva Recreación y Cultura</a></li>
                                        <li><a href="#">Club los Andes</a></li>
                                        <li><a href="#">Coomeva Turismo y Agencia de Viajes</a></li>
                                        <li><a href="#">Coomeva Hoteles y Resorts</a></li>
                                    </ul>
                                </div>
                                <div className="footer-item col-md-3">
                                    <h4>Tags</h4>
                                </div>
                                <div className="footer-item col-md-3">
                                    <h4>Contácto</h4>
                                    <p>Para conocer más acerca de nosotros, puedes ingresas al menú Nosotros, y para conocer más acerca de
                                        otros servicios que Coomeva ofrece, puedes ingresar en el menú a Coomeva. En caso de cualquier comentario,
                                        inquietud o sugerencia, puedes escribirnos al correo electrónico: <br />
                                        <a href="#">soporte@coomeva.com.co</a><br /><br />
                                        ó comunicarse al siguiente número:
                                        <a href="#">(+57) 092 545-5654</a>
                                    </p>
                                </div>
                            </div>
                            <div className="col-md-2"></div>
                        </div>
                        <div className="footer-line">
                            <div className="container-fluid">
                                <div className="col-md-3">
                                    Dieño y desarrollo por:
                                    <img src={require("./images/logo_transparent.png")} alt="" />
                                </div>
                                <div className="col-md-6 footer-line-middle text-center">
                                    @Copyright 2012-2016 - Todos los derechos reservados Radio Coomeva.
                                </div>
                                <div className="col-md-3 text-right">
                                    Siguenos en <img src={require("./images/icon-facebook.jpg")} alt="" className="footer-icon" /> <img src={require("././images/icon-twitter.jpg")} alt="" className="footer-icon" />
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </MuiThemeProvider>
        );
    }
}

export default App;