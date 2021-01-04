import React, { useState } from 'react';
import { Col, Container, Row, Table } from 'react-bootstrap';
import ReactDOM from 'react-dom';

function UserList(props) {
  const [users, setUsers] = useState(_params.users);
  const [loginUser, setLoginUser] = useState(_params.loginUser);
  return (
    <>
      <Container>
        <Row>
          <Col>
            <h3>ユーザー一覧</h3>
          </Col>
        </Row>
        <Table striped>
          <thead>
            <tr>
              <th>ユーザー名</th>
              <th>自己紹介</th>
            </tr>
          </thead>
          <tbody>
            {users.map(u =>
              <tr key={u.id}>
                <td><a href={"users/" + u.id} style={{color: "black"}}>{u.name}</a></td>
                <td>{u.bio}</td>
              </tr>
            )}
          </tbody>
        </Table>
      </Container>
    </>
  );
}

export default UserList;

if (document.getElementById('user-list')) {
    ReactDOM.render(<UserList />, document.getElementById('user-list'));
}
