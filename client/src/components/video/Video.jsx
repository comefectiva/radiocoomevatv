import React from 'react';
import {connect} from 'react-redux';
import {getVideoByUrl, customLoggin} from '../../actions/videoActions';
import PropTypes from 'prop-types';

class Video extends React.Component{

    constructor(props){
        super(props);
        let This = this;
        this.state = {
            currentVideo: {
                info: {
                    name: '',
                    requireLogin: false
                },
                image: {
                    name: '',
                },
                video: {
                    name: ''
                },
            },
            logged: false,
            field: '',
            logginError: false
        };
        let Background = "/images/background-videos.jpg";
        this.style = {
            container: {
                background: `url(${Background})`,
                backgroundSize: 'cover',
                width: '100%',
                figure: {
                    paddingTop: 250,
                    width: '60%',
                    margin: '0 auto',
                    display: 'block',
                    video: {
                        width: '100%'
                    },
                    title: {
                        fontSize: 35,
                        color: 'white'
                    }
                },
                label: {
                    color: 'white',
                    fontSize: 16,
                    textAlign: 'center'
                },
                helpBlock: {
                    color: '#f00'
                },
                error: {
                    color: 'white',
                    fontSize: 30
                }
            }
        };
        This.props.getVideoByUrl(This.props.location.pathname).then(result => {
            console.log(result);
            This.setState({
                name: result.data.info.name,
                currentVideo: result.data
            });

        });
    }
    onChange(event){
        this.setState({
            field: event.target.value
        });
    }

    componentWillMount(){
        document.body.style.height = "100%";
    }
    componentWillUnmount(){
        document.html.style.height = null;
    }

    checkUser(event){
        event.preventDefault();
        let This = this;
        this.props.customLoggin(this.state.field).then(result => {
            console.log(result);
            if(!result.data.error){
                This.setState({
                    logged: true,
                    logginError: false
                });
            }else{
                This.setState({
                    logged: false,
                    logginError: true
                });
            }
        });
    }

    render(){
        return(
            <div>
                {this.state.logged ? (
                    <div style={this.style.container}>
                        <figure style={this.style.container.figure}>
                            <video
                                id="video-mp4"
                                style={this.style.container.figure.video}
                                src={`/videos/${this.state.currentVideo.video.name}`}
                                controls
                            />
                            <h2 style={this.style.container.figure.title}>{this.state.currentVideo.info.name}</h2>
                        </figure>
                    </div>
                ):(
                    <div style={this.style.container}>
                        <figure style={this.style.container.figure}>
                            <img src="http://radiocoomevatv-comefectiva.rhcloud.com/prototipo/img/cosito_momentos_empresariales.png" alt="" width="250" />
                            <form onSubmit={this.checkUser.bind(this)} method="post">
                                <div className="form-group">
                                    <label className="control-label" style={this.style.container.label}>Ingresa tu documento</label>
                                    {this.state.logginError ? (
                                        <span className="help-block" style={this.style.container.error}>No se encontró el usuario</span>
                                    ):(
                                        <div></div>
                                    )}
                                    <input name="document" type="text" className="form-control" aria-describedby="helpBlock2" onChange={this.onChange.bind(this)} value={this.state.field} required />
                                </div>
                                <input type="hidden" name="project" value="atletas-empresariales"/>
                                <input type="hidden" name="return_false" value="http://radio.coomeva.com.co/live/programs/atletas_empresariales/login.php"/>
                                <button type="submit" className="btn btn-default">Ingresar</button>
                            </form>
                        </figure>
                    </div>
                )}
            </div>
        )
    }
}

Video.PropTypes = {
    getVideoByUrl: PropTypes.func.isRequired,
    customLoggin: PropTypes.func.isRequired
};

export default connect(null, {getVideoByUrl, customLoggin})(Video);