import React, { useState } from 'react';
import {Col, Container, Row, Table} from 'react-bootstrap';
import ReactDOM from 'react-dom';
import UserDetailCard from './UserDetailCard';

function FollowList(props) {
  const [user, setUser] = useState(_params.loginUser);
  const [follows, setFollows] = useState(_params.follows);
  return(
    <Container>
      <Row>
        <Col>
          <h3>フォロー一覧</h3>
        </Col>
      </Row>
      <Row>
        <Col md="4">
          <UserDetailCard user={user}/>
        </Col>
        <Col md="8">
          <Table>
            <thead>
              <tr>
                <th>名前</th>
                <th>自己紹介</th>
              </tr>
            </thead>
            <tbody>
              {follows.map(f =>
                <tr key={f.id}>
                  <td><a href={"/users/" + _loginUser.id} style={{color:"black"}}>{f.follow_user_name}</a></td>
                  <td>{f.follow_user_bio}</td>
                </tr>
              )}
            </tbody>
          </Table>
        </Col>
      </Row>
    </Container>
  );
}

export default FollowList;

if (document.getElementById('follow-list')) {
    ReactDOM.render(<FollowList />, document.getElementById('follow-list'));
}