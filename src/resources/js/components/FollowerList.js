import React, { useState } from 'react';
import { Col, Container, Row, Table } from 'react-bootstrap';
import ReactDOM from 'react-dom';
import UserDetailCard from './UserDetailCard';

function FollowerList(props) {
  const [user, setUser] = useState(_params.loginUser);
  const [followers, setFollowers] = useState(_params.followers);
  return(
    <Container>
      <Row>
        <Col>
          <h3>フォロワー一覧</h3>
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
              {followers.map(f =>
                <tr key={f.id}>
                  <td><a href={"/users/" + f.follower_user_id} style={{color:"black"}}>{f.follower_user_name}</a></td>
                  <td>{f.follower_user_bio}</td>
                </tr>
              )}
            </tbody>
          </Table>
        </Col>
      </Row>
    </Container>
  );
}

export default FollowerList;

if (document.getElementById('follower-list')) {
    ReactDOM.render(<FollowerList />, document.getElementById('follower-list'));
}