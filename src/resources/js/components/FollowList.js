import React from 'react';
import {Col, Container, Row} from 'react-bootstrap';
import ReactDOM from 'react-dom';

function FollowList(props) {
  return(
    <Container>
      <Row>
        <Col>
          <h3>フォロー一覧</h3>
        </Col>
      </Row>
      <Row>
      </Row>
    </Container>
  );
}

export default FollowList;

if (document.getElementById('follow-list')) {
    ReactDOM.render(<FollowList />, document.getElementById('follow-list'));
}