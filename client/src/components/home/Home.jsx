import React from 'react';
import IconMenu from 'material-ui/IconMenu';
import IconButton from 'material-ui/IconButton';
import MenuItem from 'material-ui/MenuItem';
import {
    NavigationArrowDropDown,
    AvSortByAlpha,
    ActionList,
    ActionBookmark,
    ImageTagFaces,
    ImageBlurOn,
    NavigationMoreVert
} from 'material-ui/svg-icons';
import {white} from 'material-ui/styles/colors';
import RaisedButton from 'material-ui/RaisedButton';
import FlatButton from 'material-ui/FlatButton';
import {Toolbar, ToolbarGroup, ToolbarSeparator} from 'material-ui/Toolbar';
import {Card, CardActions, CardHeader, CardMedia, CardTitle, CardText} from 'material-ui/Card';

class Home extends React.Component{

    constructor(props) {
        super(props);
        this.state = {
            type: 'Tipo',
            sort: 'Ascendente',
            grid: 'Grilla'
        };
        this.styles = {
            toolbarButton: {
                cursor: 'pointer',
                span: {
                    position: 'relative',
                    top: -7,
                    left: 7
                },
                icon: {
                    width: 25,
                    height: 25
                }
            },
            grid: {
                marginTop: 45,
                card: {
                    width: '25%',
                    header: {
                        position: 'absolute',
                        width: '20.5%'
                    },
                    media: {
                        padding: '0 15px',
                        paddingTop: 15
                    },
                    title: {
                        paddingTop: 5,
                        paddingBottom: 5
                    },
                    buttonRight: {
                        float: 'right',
                        top: -5
                    }
                },
            }
        }
    }

    changeType = (event, child) => this.setState({type: child.props.primaryText});
    changeSort = (event, child) => this.setState({sort: child.props.primaryText});
    changeGrid = (event, child) => this.setState({grid: child.props.primaryText});

    render(){
        return(
            <div className="page">
                <figure className="header-figure">
                    <img src={require('../../images/header.jpg')} alt=""/>
                    <div>
                        <h2>Contenidos</h2>
                        <hr/>
                        <br/>
                        <p>
                            Encuentra los mejores contenidos para cada una de tus clases, <br/>
                            motiva a tus estudiantes y convierte el aprendizaje en <span>inspiración.</span>
                        </p>
                    </div>
                </figure>
                <div style={ {margin: 0, marginTop: 45, background: white} }>
                    <div style={ { padding: 25 } }>
                        <h2>CURSOS Y RECURSOS SUGERIDOS</h2>
                        <div>
                            <Toolbar style={ {background:white} }>
                                <ToolbarGroup >
                                    <IconMenu
                                        iconButtonElement={
                                            <div style={this.styles.toolbarButton}>
                                                <span style={this.styles.toolbarButton.span}>
                                                    Filtro: {this.state.type}
                                                </span>
                                                <IconButton touch={true}>
                                                    <NavigationArrowDropDown style={this.styles.toolbarButton.icon} />
                                                </IconButton>
                                            </div>
                                        }
                                        onItemTouchTap={this.changeType.bind(this)}
                                    >
                                        <MenuItem primaryText="Curso" />
                                        <MenuItem primaryText="Recurso" />
                                    </IconMenu>
                                    <ToolbarSeparator />
                                    <RaisedButton label="1 Recursos Sugeridos" />
                                    <ToolbarSeparator />
                                    <IconMenu
                                        iconButtonElement={
                                            <div style={this.styles.toolbarButton}>
                                                <span style={this.styles.toolbarButton.span}>
                                                    Orden: {this.state.sort}
                                                </span>
                                                <IconButton touch={true}>
                                                    <AvSortByAlpha style={this.styles.toolbarButton.icon} />
                                                </IconButton>
                                            </div>
                                        }
                                        onItemTouchTap={this.changeSort.bind(this)}
                                    >
                                        <MenuItem primaryText="Ascendente" />
                                        <MenuItem primaryText="Descendente" />
                                    </IconMenu>
                                    <ToolbarSeparator />
                                    <IconMenu
                                        iconButtonElement={
                                            <div style={this.styles.toolbarButton}>
                                                <span style={this.styles.toolbarButton.span}>
                                                    Estilo: {this.state.grid}
                                                </span>
                                                <IconButton touch={true}>
                                                    <ActionList style={this.styles.toolbarButton.icon} />
                                                </IconButton>
                                            </div>
                                        }
                                        onItemTouchTap={this.changeGrid.bind(this)}
                                    >
                                        <MenuItem primaryText="Lista" />
                                        <MenuItem primaryText="Grilla" />
                                    </IconMenu>
                                </ToolbarGroup>
                            </Toolbar>
                            <div style={this.styles.grid}>
                                <Card style={this.styles.grid.card}>
                                    <CardHeader
                                        actAsExpander={true}
                                        showExpandableButton={true}
                                        closeIcon={<NavigationMoreVert/>}
                                        style={this.styles.grid.card.header}
                                    />
                                    <CardMedia
                                        style={this.styles.grid.card.media}
                                    >
                                        <img src={require('../../images/courses/perrito.png')} />
                                    </CardMedia>
                                    <CardTitle
                                        style={this.styles.grid.card.title}
                                        title="PET"/>
                                    <CardText>
                                        Módulo: Módulo 1<br/>
                                        Cursos: 6°, 7°, 8°, 9°
                                    </CardText>
                                    <CardActions>
                                        <FlatButton
                                            icon={<ActionBookmark
                                                style={this.styles.toolbarButton.icon}/>}
                                            label="33"
                                            style={ { width: '20%' } }
                                        />
                                        <FlatButton
                                            icon={<ImageTagFaces
                                                style={this.styles.toolbarButton.icon}/>}
                                            label="1550"
                                            style={ { width: '38%' } }
                                        />
                                        <IconButton
                                            style={this.styles.grid.card.buttonRight}
                                            touch={true}
                                        >
                                            <ImageBlurOn style={this.styles.toolbarButton.icon} />
                                        </IconButton>
                                    </CardActions>
                                </Card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Home;