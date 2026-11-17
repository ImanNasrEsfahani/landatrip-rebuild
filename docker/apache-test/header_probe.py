import json
from http.server import BaseHTTPRequestHandler, HTTPServer


class Handler(BaseHTTPRequestHandler):
    def do_GET(self):
        authorization = self.headers.get("Authorization", "")
        body = json.dumps({
            "authorization_scheme": authorization.partition(" ")[0],
            "probe_bearer_received": authorization == "Bearer isolated-probe-token",
            "staging_header_present": "X-Staging-Api-Authorization" in self.headers,
            "forwarded_proto": self.headers.get("X-Forwarded-Proto", ""),
        }).encode()
        self.send_response(200)
        self.send_header("Content-Type", "application/json")
        self.send_header("Content-Length", str(len(body)))
        self.end_headers()
        self.wfile.write(body)

    def log_message(self, format, *args):
        pass


HTTPServer(("0.0.0.0", 8082), Handler).serve_forever()
