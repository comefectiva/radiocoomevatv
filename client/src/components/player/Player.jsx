import React from 'react';
import { connect } from 'react-redux';
import PropTypes from 'prop-types';
import { getSource } from '../../actions/playerActions';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../style.css';
class Player extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            currentRadio: 'adulto',
            isPLaying: false,
            song: {
                artist: null,
                album: null,
                cover: null
            }
        }
    }

    getSource(param){
        let This = this;
        This.setState({
            currentRadio: param
        });
        this.props.getSource(param).then( result => {
            console.log(result);
        });
    }

    render(){
        let listRadiosActive = false;
        return(
            <aside className="{{currentRadio.replace(' ','_')}}">
                <figure className="player">
                    <div className="panel-group radio-list" id="accordion" role="tablist" aria-multiselectable="true">
                        <div className="panel panel-default panel-adulto-contemporaneo">
                            <div
                                onMouseOver={() => {listRadiosActive = true} }
                                onMouseLeave={ ()=>{listRadiosActive = false} }
                                className="panel-heading"
                                role="tab"
                                id="headingOne"
                            >
                                <h4 className="panel-title">
                                    <a role="button" aria-expanded="true">
                                        <span>{this.state.currentRadio}</span>
                                        <i className={listRadiosActive ? 'glyphicon glyphicon-play active' : 'glyphicon glyphicon-play'}/>
                                    </a>
                                </h4>
                                <div className={listRadiosActive ? 'list-group active' : 'list-group'}>
                                    <a onClick={ ()=> {this.getSource('adulto')} } className="list-group-item">Adulto Contemporaneo</a>
                                    <a onClick={ ()=> {this.getSource('instrumental')} } className="list-group-item">Instrumental</a>
                                    <a onClick={ ()=> {this.getSource('jovenes')} } className="list-group-item">Jovenes</a>
                                </div>
                            </div>
                            <div id="collapseOne" className="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div className="background-image" id="imagen-cancion"></div>
                                <div className="vintage_back"></div>
                                <div className="panel-body">
                                    <figure className="player player-adulto" title="Próxima Canción">
                                        <div className="cover">
                                            <img src={this.state.song.cover} alt="" id="vintage-imagen-cancion"/>
                                            <div className="nexty">
                                                <strong>
                                                    <span>Próxima canción</span>
                                                    <div id="artistacancion-next">Artista</div>

                                                </strong>
                                            </div>
                                        </div>

                                        <div className="current-song">
                                            <div id="artistacancion">Artista</div>
                                            <div id="titulocancion">Titulo</div>
                                        </div>


                                        <div className="player-control">
                                            <div
                                                id="EventoPlayer"
                                                style={ {
                                                    width: 22,
                                                    height: 22,
                                                    display: 'block',
                                                    paddingLeft: 15
                                                    }
                                                }
                                            >
                                                <a id="events-player" href="Javascript:void(0);" alt="played">
                                                    <img src={require("../images/stop.png")} alt="stop" width="22" height="22" />
                                                        <audio onLoad={ () => {this.play()} } id="playing" autoPlay={true} preload="none">
                                                            <source src="http://radio.coomeva.com.co:8090/adulto.mp3" type="audio/mpeg"/>
                                                        </audio>
                                                </a>
                                            </div>
                                        </div>


                                        <div className="eq-bars-container ">
                                            <div className="eq-bar eq-bar-1"></div>
                                            <div className="eq-bar eq-bar-2"></div>
                                            <div className="eq-bar eq-bar-3"></div>
                                            <div className="eq-bar eq-bar-4"></div>
                                            <div className="eq-bar eq-bar-5"></div>
                                            <div className="eq-bar eq-bar-6"></div>
                                            <div className="eq-bar eq-bar-7"></div>
                                            <div className="eq-bar eq-bar-8"></div>
                                            <div className="eq-bar eq-bar-9"></div>
                                            <div className="eq-bar eq-bar-10"></div>
                                            <div className="eq-bar eq-bar-11"></div>
                                            <div className="eq-bar eq-bar-12"></div>
                                            <div className="eq-bar eq-bar-13"></div>
                                            <div className="eq-bar eq-bar-14"></div>
                                            <div className="eq-bar eq-bar-15"></div>
                                        </div>

                                    </figure>

                                </div>
                            </div>
                        </div>
                    </div>
                </figure>

                <div className="top-10">
                    <div className="top10-player-lyrics">
                        Lyrics
                    </div>
                    <h3>TOP 10</h3>
                    <div className="list-group">
                        <a className="list-group-item row" onClick={() => {console.log('getTop10Item')}}>
                            <figure className="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <img src="{{item.cover}}" alt="" />
                            </figure>
                            <div className="song-information col-xs-8 col-sm-8 col-md-8 col-lg-8 row">
                                <strong className="artist-top-10 col-xs-12 col-sm-12 col-md-12 col-lg-12">artist</strong>
                                <span className="song-top-10 col-xs-12 col-sm-12 col-md-12 col-lg-12">song</span>
                            </div>
                            <div className="play-top-10 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <i className="glyphicon glyphicon-play"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
        );
    }
}

Player.PropTypes = {
    getSource: PropTypes.func.isRequired,
    isPlaying: PropTypes.bool.isRequired
};

export default connect(null, { getSource })(Player);