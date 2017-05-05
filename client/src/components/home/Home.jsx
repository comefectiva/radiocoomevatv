import React from 'react';
import {connect} from 'react-redux';
import Player from '../player/Player';
import {Carousel} from "react-bootstrap";

class Home extends React.Component{

    constructor(props){
        super(props);
        let This = this;
        This.state = {
            podcastProgress: 0,
            radioPlaying: true
        };
    }

    render(){
        let openInteres = false;
        return(
            <div className="row template-container">
                <Player ref={(player) => {this._player = player}}/>
                <section className="row section-home-flex">
                    <Carousel id="home-slider">
                        <Carousel.Item>
                            <img alt="900x500" src={require('../images/ella.png')}/>
                        </Carousel.Item>
                        <Carousel.Item>
                            <img alt="900x500" src={require('../images/main-banner.jpg')}/>
                        </Carousel.Item>
                    </Carousel>
                    <div className="row">
                        <div className="col-xs-6 col-sm-6 col-md-6 col-lg-6 podcast-home-section home-section">
                            <h2><strong>POD<span>CAST</span></strong> <hr /></h2>
                            <div className="home-podcast">
                                <uib-carousel id="slider-home-podcasts" active="0" no-wrap="false">
                                    <uib-slide index="0">
                                        <figure className="row compact-player">/*Onclick*/
                                            <figure className="playButton">
                                                <i className="soundsPodcastsHome.soundPodcast_0=='stop' ? 'glyphicon glyphicon-play' : 'glyphicon glyphicon-pause'"></i>
                                            </figure>
                                            <figure className="podcast-img-container">
                                                <img src="http://radio.coomeva.com.co/.storage/podcast_27/thumb/cepeda.jpg" className="col-xs-7 col-sm-7 col-md-7 col-lg-7" alt="" />

                                            </figure>
                                            <div className="miniplayer col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                <div id="equalizer-podcast-0">

                                                </div>
                                                <div className="podcast-controls row"
                                                     style= { {
                                                            position: 'relative',
                                                            top: 19
                                                        }
                                                     }
                                                >
                                                    <figure className="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <input
                                                            className="podcast-progress form-control ng-pristine ng-valid ng-touched"
                                                            type="range"
                                                            min="0" max="1"
                                                            step="0.01"
                                                            value={this.state.podcastProgress}
                                                        />
                                                    </figure>
                                                </div>
                                            </div>
                                        </figure>
                                        <div className="carousel-caption">
                                            <h3 className="item-title">Andres Cepeda gira nacional <strong className="item-subtitle">Especiales Coomeva Personajes</strong></h3>
                                            <p>
                                                Disfrute los últimos éxitos de este cantante bogotano y sus temas de siempre.
                                                Nominado a los premios más famosos de la música, está de gira por las principales ciudades del país.<br /><br />

                                                Adquiera sus boleta en Coomeva Recreación y Cultura, y benefíciese con los descuentos especiales de los asociados.<br /><br />

                                                Asista a sus conciertos con Coomeva Recreación y Cultura.Informes: <a href="http://recreacionycultura.coomeva.com.co">recreacionycultura.coomeva.com.co</a>
                                            </p>
                                            <div style= { {  paddingTop:15 } }></div>
                                        </div>
                                    </uib-slide>
                                    <uib-slide index="1">
                                        <figure className="row">
                                            <img src="http://radio.coomeva.com.co/.storage/podcast_27/thumb/00000df45.jpg" className="col-xs-6 col-sm-6 col-md-6 col-lg-6" alt="" />
                                            <div className="miniplayer col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div id="equalizer-podcast-1" ></div>
                                                <button type="button" name="button" onClick={ () => console.log("playHomePodcast(1)") }>play</button>
                                            </div>
                                        </figure>
                                        <div className="carousel-caption">
                                            <h3>Cero Humo <strong className="subtitle">Especiales Coomeva Salud</strong></h3>
                                            <p>
                                                Coomeva Medicina Prepagada, Coomeva EPS y Sinergia Salud quieren entregarte consejos para que te cuides.<br />
                                                Hoy hablaremos de cómo nos puede afectar el cigarrillo, que pasa en nuestro cuerpo al dejar de fumar y por que debemos buscar siempre libres de humo.<br />
                                                Bienvenidos!
                                            </p>
                                        </div>
                                    </uib-slide>
                                </uib-carousel>
                            </div>
                            <div className="ver-mas-home">
                                <button type="button" name="button" href="podcasts" >
                                    Ver más podcasts...
                                </button>
                            </div>
                        </div>

                        <div id="home-interes" className="!openInteres ? 'col-xs-4 col-sm-4 col-md-4 col-lg-4 row home-section home-interes' : 'col-xs-4 col-sm-4 col-md-4 col-lg-4 row home-section home-interes active'">
                            <div className="!openInteres ? 'list-intereses' : 'list-intereses active'"
                                 style={ {
                                        //width: { { widthNews } }px
                                    }
                                 }
                                >
                                <h2><strong>INTERES</strong><hr /></h2>
                                <div href="noticia({noticeId: item.id})" className="home-interes-item row col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <figure className="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                        <img src="http://radio.coomeva.com.co/.storage/noticias_1/{{item.imagen}}" alt="" />
                                    </figure>
                                    <div className="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                        <span className="date"></span>
                                        <strong> item.nombre </strong>
                                    </div>
                                </div>

                                <div className="ver-mas-home interes">
                                    <button type="button" name="button" onClick={ () => {openInteres = !openInteres}}>
                                        Ver más noticias...
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div className="col-xs-2 col-sm-2 col-md-2 col-lg-2 publicidad-home home-section">
                            <figure>
                                <img src={require("../images/coomeva-turismo.jpg")} alt="" />
                            </figure>
                        </div>
                    </div>

                    <div className="row campaign_banner">
                        <figure className="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <a href="#">
                                <img src="http://radio.coomeva.com.co/live/media/images/Radio%20Coomeva%20PPAL.jpg" alt="" />
                            </a>
                        </figure>
                    </div>
                </section>
                <div id="audio-element"></div>
            </div>
        )
    }
}

export default connect(null, {})(Home);