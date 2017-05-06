import React from 'react';
import { connect } from 'react-redux';
import { getVideos } from '../../../actions/videoActions';
import PropTypes from 'prop-types';
import {Toolbar, ToolbarGroup, ToolbarSeparator, ToolbarTitle} from 'material-ui/Toolbar'
import FontIcon from 'material-ui/FontIcon';
import RaisedButton from 'material-ui/RaisedButton';
import IconButton from 'material-ui/IconButton';
import DropDownMenu from 'material-ui/DropDownMenu';
import MenuItem from 'material-ui/MenuItem';
import IconMenu from 'material-ui/IconMenu';
import {
    AvSortByAlpha
} from 'material-ui/svg-icons';
import {
    Table,
    TableBody,
    TableHeader,
    TableHeaderColumn,
    TableRow,
    TableRowColumn,
} from 'material-ui/Table';
import {red500, orange500} from 'material-ui/styles/colors';



class VideoListDatabase extends React.Component{

    constructor(props) {
        super(props);
        this.state = {
            videoList: []
        };
        this.styles = {
            toolbarTitle: {
                fontSize: 30,
                color: '#333'
            }
        };

        //GET VIDEOS
        this.props.getVideos().then(result => {
            this.setState({
                videoList: result.data
            });
        });
    }

    render(){
        return(
            <div className="page">
                <Toolbar>
                    <ToolbarGroup>
                        <ToolbarTitle text="Lista de Videos" style={this.styles.toolbarTitle}/>
                    </ToolbarGroup>
                    <ToolbarGroup firstChild={true}>
                        <DropDownMenu value={this.state.value} onChange={this.handleChange}>
                            <MenuItem value={1} primaryText="All Broadcasts" />
                            <MenuItem value={2} primaryText="All Voice" />
                            <MenuItem value={3} primaryText="All Text" />
                            <MenuItem value={4} primaryText="Complete Voice" />
                            <MenuItem value={5} primaryText="Complete Text" />
                            <MenuItem value={6} primaryText="Active Voice" />
                            <MenuItem value={7} primaryText="Active Text" />
                        </DropDownMenu>
                    </ToolbarGroup>
                    <ToolbarGroup>
                        <ToolbarTitle text="Options" />
                        <FontIcon className="muidocs-icon-custom-sort" />
                        <ToolbarSeparator />
                        <RaisedButton label="Create Broadcast" primary={true} />
                        <IconMenu
                            iconButtonElement={
                                <IconButton touch={true}>
                                    <AvSortByAlpha />
                                </IconButton>
                            }
                        >
                            <MenuItem primaryText="Download" />
                            <MenuItem primaryText="More Info" />
                        </IconMenu>
                    </ToolbarGroup>
                </Toolbar>
                <Table>
                    <TableHeader displaySelectAll={false} adjustForCheckbox={false}>
                        <TableRow>
                            <TableHeaderColumn>ID</TableHeaderColumn>
                            <TableHeaderColumn>Título</TableHeaderColumn>
                            <TableHeaderColumn>URL</TableHeaderColumn>
                            <TableHeaderColumn>Sector</TableHeaderColumn>
                            <TableHeaderColumn>Fecha de creación</TableHeaderColumn>
                            <TableHeaderColumn>Acciones</TableHeaderColumn>
                        </TableRow>
                    </TableHeader>
                    <TableBody displayRowCheckbox={false}>
                        {
                            this.state.videoList.map(video => {
                                return(
                                    <TableRow key={video.id}>
                                        <TableRowColumn>{video.id}</TableRowColumn>
                                        <TableRowColumn>{video.name}</TableRowColumn>
                                        <TableRowColumn>{video.url}</TableRowColumn>
                                        <TableRowColumn>{video.sector}</TableRowColumn>
                                        <TableRowColumn>{video.created_at}</TableRowColumn>
                                        <TableRowColumn>
                                            <RaisedButton label="Añadir DB" href={"/admin/db/"+video.id} backgroundColor={orange500}/>
                                        </TableRowColumn>
                                    </TableRow>
                                )
                            })
                        }
                    </TableBody>
                </Table>
            </div>
        );
    }
}

VideoListDatabase.PropTypes = {
    getVideos: PropTypes.func.isRequired
};

export default connect(null, { getVideos })(VideoListDatabase);