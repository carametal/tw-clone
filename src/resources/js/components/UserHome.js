import Axios from 'axios';
import React, {useEffect, useState} from 'react';
import { Button, Card, Col, Container, Form, Row } from 'react-bootstrap';
import ReactDOM from 'react-dom';

function UserHome(props) {
  const [user, setUser] = useState(_params.user);
  const handleChangeUser = (event, propertyName) => {
    const newUser = Object.assign({}, user);
    newUser[propertyName] = event.target.value;
    setUser(newUser);
  };
  const handleSave = () => {
    const params = {
      name: user.name,
      email: user.email,
      bio: user.bio
    };
    Axios.put('/users/' + user.id, params)
      .then(res => {
        alert('正常に更新されました');
      })
      .catch(error => {
        console.error(error);
      })
  };
  return (
    <>
    <Container>
      <Row className="justify-content-center">
        <Col md="8">
          <Card>
            <Card.Header>ユーザー情報</Card.Header>
            <Card.Body>
              <Form>
                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>Name</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      type="text"
                      defaultValue={user.name}
                      onChange={(e) => handleChangeUser(e, 'name')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>Email</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      type="text"
                      defaultValue={user.email}
                      onChange={(e) => handleChangeUser(e, 'email')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>Bio</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      as="textarea"
                      rows={5}
                      defaultValue={user.bio}
                      onChange={(e) => handleChangeUser(e, 'bio')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md={{ span:8, offset: 4}}>
                    <Button onClick={handleSave}>更新</Button>
                  </Col>
                </Form.Group>

              </Form>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
    </>
  );
}

export default UserHome;

if (document.getElementById('user-root')) {
    ReactDOM.render(<UserHome />, document.getElementById('user-root'));
}
