import React from 'react';
import { Button, Col, Row } from 'react-bootstrap';

export default function Tweet(props) {
  return (
    <Row key={props.tweet.id} style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', borderTop: 'none', backgroundColor: 'white' }}>
      <Col>
        <h3>{props.tweet.name}</h3>
        <div>{props.tweet.tweet}</div>
        <div style={{paddingTop: '5px'}}>
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.favorite_id == null &&
            <Button
              size="sm"
              style={{ marginRight: '5px'}}
              onClick={() => props.handleFavorite(props.tweet)}
            >お気に入りに登録する</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.favorite_id != null &&
            <Button
              size="sm"
              variant="outline-danger"
              style={{ marginRight: '5px'}}
              onClick={() =>props.handleRemoveFavorite(props.tweet)}
            >お気に入りを解除する</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.follow_id == null &&
            <Button
              size="sm"
              onClick={() =>props.handleFollow(props.tweet)}
            >フォローする</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.follow_id != null &&
            <Button
              size="sm"
              variant="outline-danger"
              onClick={() => props.handleRemoveFollow(props.tweet)}
            >フォロー解除する</Button>
          }
          {props.tweet.user_id == _loginUser.id &&
            <Button
              size="sm"
              variant="danger"
              onClick={() => props.handleRemoveTweet(props.tweet)}
            >ツイートを削除する</Button>
          }
        </div>
      </Col>
    </Row>
  );
}
