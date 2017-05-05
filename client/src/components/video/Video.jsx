import React from 'react';
import {connect} from 'react-redux';
import {getVideoByUrl} from '../../actions/videoActions';
import PropTypes from 'prop-types';

class Video extends React.Component{

    constructor(props){
        super(props);
        let This = this;
        this.state = {
            currentVideo: {
                image: {
                    name: '',
                },
                video: {
                    name: ''
                }
            }
        };
        let bck = '/images/background-videos.jpg';
        this.style = {
            container: {
                background: 'url('+bck+')',
                backgroundSize: 'cover'
            }
        };
        This.props.getVideoByUrl(This.props.location.pathname).then(result => {
            console.log(result);
            This.setState({
                currentVideo: result.data
            });
        });
    }

    render(){
        return(
            <div style={this.style.container}>
                <video id="video-mp4" style="width:100%;" src="http://radio.coomeva.com.co/live/programs/videos/CONFERENCIA_APNEA_web.mp4" controls></video>
            </div>
        )
    }
}

Video.PropTypes = {
    getVideoByUrl: PropTypes.func.isRequired
};

export default connect(null, {getVideoByUrl})(Video);