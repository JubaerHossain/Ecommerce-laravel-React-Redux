import React, { Component, Fragment } from 'react'
import {PropTypes} from 'prop-types';
import {connect} from 'react-redux';
import RightNav from '../common/RightNav';
import { allTransfers } from '../../actions/profileAction';

class Transfer extends Component {
    componentDidMount(){
        this.props.allTransfers()
    }
    render() {
        const {transfers} = this.props.profile
        return (
            <Fragment>
            <div className="container mt-5">
                <div className="row">
                    <div className="col-md-4">
                        <RightNav />
                    </div>
                    <div className="col-md-8">
                        <table className="table table-bordered">
                            <thead>
                                <tr>
                                    <th colSpan="6" className="text-center">Transfer Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Target</th>
                                    <th scope="col">Incentive</th>
                                    <th scope="col">Self + DM</th>
                                    <th scope="col">Achieved</th>
                                    <th scope="col">Approved Incentive</th>
                                    <th scope="col">Total</th>
                                </tr>
                                {transfers.length > 0 && transfers.length != 987 && transfers.length != 969 ? transfers.map(data => <tr>
                                    <td>{data.target}</td>
                                    <td>{data.incentive}</td>
                                    <td>{data.snd}</td>
                                    <td>{data.achieved}</td>
                                    <td>{data.approved}</td>
                                    <td>{data.approved + data.snd}</td>
                                </tr>)
                                 : null}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </Fragment>
        )
    }
}
Transfer.propTypes = {
    profile: PropTypes.object.isRequired
}
const mapStateToProps = state => ({
    profile: state.profile,
})
export default connect(mapStateToProps, {allTransfers})(Transfer)