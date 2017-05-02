import React from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {getVideoByUrl} from '../actions/videoActions';

class Video extends React.Component{

    constructor(props){
        super(props);
        this.props.getVideoByUrl(props.location.pathname).then(result => {
            console.log(result);
        });
    }

    render(){
        return(
            <div>
                Video
            </div>
        )
    }
}

Video.PropTypes = {
    getVideoByUrl: PropTypes.func.isRequired
};
export default connect(null, {getVideoByUrl})(Video);