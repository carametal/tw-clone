import React, {useEffect, useState} from 'react';
import {Button, Card, Col, Row} from "react-bootstrap";

export default function TimeLine() {
  const [tweets, setTweets] = useState([]);

  useEffect(() => {
    axios.get('timeline')
      .then(res => setTweets(res.data))
      .catch(error => console.error(error));
  }, []);

  return(
    <>
      <Row style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', backgroundColor: 'rgba(0, 0, 0, 0.03)' }}>
        <Col>すべてのツイート</Col>
      </Row>
      {tweets.map(t => {
        return(
          <Row key={t.id} style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', borderTop: 'none' }}>
            <Col>
              <h3>{t.name}</h3>
              <div>{t.tweet}</div>
              <div style={{paddingTop: '5px'}}>
                <Button size="sm" style={{ marginRight: '5px'}}>お気に入り</Button>
                <Button size="sm">フォローする</Button>
              </div>
            </Col>
          </Row>
        );
      })}
    </>
  );

}

