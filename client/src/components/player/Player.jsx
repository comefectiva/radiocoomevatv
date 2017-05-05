import React from 'react';
import { connect } from 'react-redux';
import PropTypes from 'prop-types';
import { getSource, getRadioList, getSourceInfo, playerGlobalHandler } from '../../actions/playerActions';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../style.css';
class Player extends React.Component{

    constructor(props){
        super(props);
        let This = this;
        this.state = {
            listRadios: [],
            defaultRadio: 1,
            currentRadio: {
                source: '',
                name: '',
                infoPath: '',
                coverPath: ''
            },
            listActive: 'inactive',
            isPlaying: true,
            currentSong: {
                title: '',
                artist: '',
                album: '',
                cover: ''
            },
            nextSong: {
                title: '',
                artist: '',
                album: '',
                cover: ''
            },
            historySongs: []
        };
        //Get Radios for this page
        This.props.getRadioList().then(result => {
            This.setState( {listRadios: result.data} );
            // Initiate the default radio
            for(let i = 0, len = result.data.length; i < len; i++) {
                if (result.data[i].id === this.state.defaultRadio) {
                    let currentRadio = result.data[i];
                    This.setState({
                        currentRadio: {
                            source: currentRadio.source,
                            name: currentRadio.name,
                            infoPath: currentRadio.infoFile,
                            coverPath: currentRadio.coverPath
                        }
                    });
                    This.getSourceInfo();
                    break;
                }
            }
        });
        //Initiate Source search
        This.timeout = setInterval(function(){
            This.getSourceInfo();
        }, 5000);
    }

    getSource(param){
        let This = this;
        this.props.getSource(param).then( result => {
            This.setState({
                currentRadioName: result.data.name
            });
            this.props.playerGlobalHandler(true);
        });
    }

    getSourceInfo(){
        let This = this;
        This.props.getSourceInfo(This.state.currentRadio).then(result => {
            let sourceInfo = result.data;
            This.setState({
                currentSong: {
                    title: sourceInfo.current.title,
                    artist: sourceInfo.current.artist,
                    album: sourceInfo.current.album,
                    cover: sourceInfo.current.album_art
                },
                nextSong: {
                    title: sourceInfo.next.title,
                    artist: sourceInfo.next.artist,
                    album: sourceInfo.next.album,
                    cover: sourceInfo.next.album_art
                }
            });
        });
    }

    playerAction(){
        if(this.state.isPlaying === false){
            this.audio.load();
            this.audio.play();
            this.setState({
                isPlaying: true
            });
            this.props.playerGlobalHandler(true);
        }else{
            this.audio.pause();
            this.setState({
                isPlaying: false
            });
            this.props.playerGlobalHandler(false);
        }
    }

    render(){
        return(
            <aside className={this.state.currentRadio.name.replace(' ','_')}>
                <figure className="player">
                    <div className="panel-group radio-list" id="accordion" role="tablist" aria-multiselectable="true">
                        <div className="panel panel-default panel-adulto-contemporaneo">
                            <div
                                onMouseOver={() =>{this.setState({ listActive: 'active' })} }
                                onMouseLeave={ ()=>{this.setState({ listActive: 'inactive' })} }
                                className="panel-heading"
                                role="tab"
                                id="headingOne"
                            >
                                <h4 className="panel-title">
                                    <a role="button" aria-expanded="true">
                                        <span>{this.state.currentRadio.name}</span>
                                        <i className={`glyphicon glyphicon-play ${this.state.listActive}`}/>
                                    </a>
                                </h4>
                                <div className={`list-group ${this.state.listActive}`}>
                                    {
                                        this.state.listRadios.map(radio => {
                                            return(
                                                <a
                                                    key={radio.id}
                                                    onClick={ ()=> {this.getSource(radio.id)} }
                                                    className="list-group-item">
                                                    {radio.name}
                                                </a>
                                            );
                                        })
                                    }
                                </div>
                            </div>
                            <div id="collapseOne" className="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div className="background-image" id="imagen-cancion"></div>
                                <div className="vintage_back"></div>
                                <div className="panel-body">
                                    <figure className="player player-adulto" title="Próxima Canción">
                                        <div className="cover">
                                            <img src={this.state.currentSong.cover} alt="" id="vintage-imagen-cancion"/>
                                            <div className="nexty">
                                                <strong>
                                                    <span>Próxima canción</span>
                                                    <div id="artistacancion-next">{this.state.nextSong.title}</div>
                                                </strong>
                                            </div>
                                        </div>

                                        <div className="current-song">
                                            <div id="artistacancion">{this.state.currentSong.artist}</div>
                                            <div id="titulocancion">{this.state.currentSong.title}</div>
                                        </div>


                                        <div className="player-control">
                                            <div
                                                id="EventoPlayer"
                                                style={{
                                                    width: 22,
                                                    height: 22,
                                                    display: 'block',
                                                    paddingLeft: 15
                                                }}
                                            >
                                                <a id="events-player" onClick={this.playerAction.bind(this)} alt="played">
                                                    {this.state.isPlaying ? (
                                                        <img src={require("../images/stop.png")} alt="stop" width="22" height="22" />
                                                    ):(
                                                        <img src={require("../images/play.png")} alt="play" width="22" height="22" />
                                                    )}
                                                    <audio
                                                        ref={(audio)=> {this.audio = audio}}
                                                        preload="none"
                                                        src={this.state.currentRadio.source}
                                                        autoPlay={true}
                                                    >
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
    getRadioList: PropTypes.func.isRequired,
    getSourceInfo: PropTypes.func.isRequired,
    playerGlobalHandler: PropTypes.func.isRequired,
    isPlaying: PropTypes.bool.isRequired
};

export default connect(null, { getSource, getRadioList, getSourceInfo, playerGlobalHandler })(Player);