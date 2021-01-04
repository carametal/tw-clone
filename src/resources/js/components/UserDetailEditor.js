import React from 'react';
import { Button, Card, Col, Container, Form, Row } from 'react-bootstrap';

export default function UserDetailEditor(props) {
  return (
    <Container>
      <Row className="justify-content-center">
        <Col md="8">
          <Card>
            <Card.Header>ユーザー情報</Card.Header>
            <Card.Body>
              <Form>
                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>ユーザー名</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      type="text"
                      defaultValue={props.user.name}
                      onChange={(e) => props.handleChangeUser(e, 'name')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>Eメールアドレス</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      type="text"
                      defaultValue={props.user.email}
                      onChange={(e) => props.handleChangeUser(e, 'email')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md="4" className="text-md-right">
                    <Form.Label>自己紹介</Form.Label>
                  </Col>
                  <Col md="6">
                    <Form.Control
                      as="textarea"
                      rows={5}
                      defaultValue={props.user.bio}
                      onChange={(e) => props.handleChangeUser(e, 'bio')}
                    />
                  </Col>
                </Form.Group>

                <Form.Group as={Row}>
                  <Col md={{ span:8, offset: 4}}>
                    <Button onClick={props.handleSave}>更新</Button>
                  </Col>
                </Form.Group>

              </Form>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}